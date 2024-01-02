<?php

namespace App\Http\Controllers;

use App\Jobs\ShareJob;
use App\Models\FbAuth;
use App\Models\FbPages;
use App\Models\Posts;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect('/');
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        FbAuth::updateOrCreate([
            'id' => $user->id,
            'email' => $user->email,
        ], [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'attributes' => json_encode($user->attributes),
            'token' => $user->token,
        ]);

        // Logic to create and share a post on Facebook goes here

        return redirect('setting/socials')->with('success', 'Account Connected Successfully');
    }

    public function addPages()
    {
        $user = FbAuth::first();
        $fb = new \Facebook\Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_access_token' => $user->token,
            'default_graph_version' => 'v18.0'
        ]);

        try {
            // get pages list
            $cacheAccounts = cache('cachedAccounts');
            if (!$cacheAccounts || true) {
                $response = $fb->get("{$user->id}/accounts?fields=access_token,instagram_business_account,tasks,category,category_list,id,name", $user->token);
                Cache::put('cachedAccounts', $response, 60 * 10);
            } else {
                $response = $cacheAccounts;
            }
            $pages = json_decode($response->getBody(), false)->data;
            $data['pages'] = [];

            // filter pages with instagram
            foreach ($pages as $page) {
                $cacheIgId = cache('cachedIgId' . $page->id);
                if (!$cacheIgId) {
                    $ig_id = json_decode($fb->get("{$page->id}?fields=picture,instagram_business_account,id,instagram_accounts{profile_pic,username}", $page->access_token)->getBody(), false);
                    cache()->put('cachedIgId' . $page->id, $ig_id, 60 * 10);
                } else {
                    $ig_id = $cacheIgId;
                }
                
                if (!empty($ig_id->instagram_business_account)) {
                    $page->ig = $ig_id;
                    $data['pages'][] = $page;
                }
            }
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        return view('settings.social_components.add_fb_pages', $data);
    }

    public function insertPages(Request $request)
    {
        try {
            $data = json_decode($request->pageData, false);
            FbPages::truncate();
            FbPages::updateOrCreate(['id' => $data->id], [
                'id' => $data->id,
                'name' => $data->name,
                'category' => $data->category,
                'category_list' => json_encode($data->category_list),
                'access_token' => $data->access_token,
                'tasks' => json_encode($data->tasks),
                'page_avatar' => $data->ig->picture->data->url,
                'instagram_business_id' => $data->ig->instagram_business_account->id,
                'instagram_id' => $data->ig->instagram_accounts->data[0]->id,
                'instagram_username' => $data->ig->instagram_accounts->data[0]->username,
                'instagram_profile_pic' => $data->ig->instagram_accounts->data[0]->profile_pic,
            ]);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle Graph error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle Facebook SDK error
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return redirect('setting/socials')->with('success', 'Page Added Successfully');
    }

    /**
     * Share a post to Facebook and Instagram.
     *
     * @param Request $request The request object containing the post data.
     * @return \Illuminate\Http\RedirectResponse
     */


    public function handleLogout()
    {
        $fbAuth = FbAuth::first();
        $fbAuth->truncate();
        $fbPages = FbPages::truncate();
        return redirect()->back();
    }

    public function share()
    {

        
        $post = Posts::find(22446);
        $link = route('singlePost', [
            'rubrik' => Str::slug($post->rubrik->rubrik_name),
            'post_id' => $post->post_id,
            'slug' => $post->slug,
        ]);
        $message = $post->description;
        $image = url('/').get_post_image(22446);
        $tag_list = '';
        if ($post->tags != null and $post->tags != 'null') {
            foreach (json_decode($post->tags) as $tags) {
                $tag = Tags::find($tags);
                $tag_name = str_replace(' ', '', $tag->tag_name);
                $tag_list .= " #{$tag_name} ";
            }
        }
        $this->sharePostToInstagram($message, $image, $link, $tag_list);
    }

    public function sharePostToInstagram($message, $image, $link, $tags)
    {
        // Validate $user and $page objects
        $user = FbAuth::firstOrFail();
        $page = FbPages::firstOrFail();

        // Create a new Facebook object with the required credentials
        $fb = new \Facebook\Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_access_token' => $user->token,
            'default_graph_version' => 'v18.0'
        ]);

        // Set the link and message data for the post
        $linkData = [
            'link' => $link,
            'message' => $message.' '.$tags,
        ];


            // Set the image URL and caption for the Instagram post
            $postToInstagramContainer = $fb->post("{$page->instagram_id}/media", [
                'image_url' => $image,
                'caption' => $linkData['message'] . ' ' . $linkData['link']
            ], $page->access_token);

            // Publish the Instagram post
            $publish = $fb->post("{$page->instagram_id}/media_publish", [
                'creation_id' => json_decode($postToInstagramContainer->getBody())->id
            ], $page->access_token);

    }
}
