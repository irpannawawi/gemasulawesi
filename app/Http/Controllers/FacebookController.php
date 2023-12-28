<?php

namespace App\Http\Controllers;

use App\Models\FbAuth;
use App\Models\FbPages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
            'app_secret' => env('FACEBOOK_SECRET'),
            'default_access_token' => $user->token,
            'default_graph_version' => 'v18.0'
        ]);

        try {
            $cacheAccounts = cache('cachedAccounts');
            if (!$cacheAccounts) {
                $response = $fb->get("{$user->id}/accounts?fields=id,instagram_business_account,category,category_list,tasks,name,access_token,picture{url}", $user->token);
                Cache::put('cachedAccounts', $response, 60 * 10);
            } else {
                $response = $cacheAccounts;
            }

            $pages = json_decode($response->getBody(), false)->data;
            $data['pages'] = [];

            foreach ($pages as $page) {
                $cacheIgId = cache('cachedIgId' . $page->id);
                if (!$cacheIgId) {
                    $ig_id = json_decode($fb->get("{$page->id}?fields=instagram_business_account", $page->access_token)->getBody(), false);
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
                'instagram_id' => $data->instagram_business_account->id,
                'page_avatar' => $data->picture->data->url,
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
    public function sharePostToFacebook(Request $request)
    {
        // Get the first FbAuth and FbPages objects
        $user = FbAuth::first();
        $page = FbPages::first();
    
        // Create a new Facebook object with the required credentials
        $fb = new \Facebook\Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_SECRET'),
            'default_access_token' => $user->token,
            'default_graph_version' => 'v18.0'
        ]);
    
        // Set the link and message data for the post
        $linkData = [
            'link' => $request->link,
            'message' => $request->message,
        ];
    
        try {
            // Post the link data to the Facebook page feed
            $fb->post("{$page->id}/feed", $linkData, $page->access_token);
    
            // Set the image URL and caption for the Instagram post
            $image_url = "https://dummyimage.com/2048x2048/000/fff.jpg&text=this+picture+originates+from+the+autoPost+app";
            $postToInstagramContainer = $fb->post("{$page->instagram_id}/media", [
                'image_url' => $image_url,
                'caption' => $linkData['link'] . '\n' . $linkData['message']
            ], $page->access_token);
    
            // Publish the Instagram post
            $fb->post("{$page->instagram_id}/media_publish", [
                'creation_id' => json_decode($postToInstagramContainer->getBody())->id
            ], $page->access_token);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error, display the error message
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues, display the error message
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    
        // Redirect back to the previous page
        return redirect()->back();
    }

    public function handleLogout()
    {
        $fbAuth = FbAuth::first();
        $fbAuth->truncate();
        $fbPages = FbPages::truncate();
        return redirect()->back();
    }
}