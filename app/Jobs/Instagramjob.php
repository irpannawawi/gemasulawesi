<?php

namespace App\Jobs;


use App\Models\FbAuth;
use App\Models\FbPages;
use App\Models\Posts;
use App\Models\Tags;
use App\Models\XAuth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Noweh\TwitterApi\Client;
use Illuminate\Support\Str;

class Instagramjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $id;

    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $post = Posts::find($this->id);
        $link = route('singlePost', [
            'rubrik' => Str::slug($post->rubrik->rubrik_name),
            'post_id' => $post->post_id,
            'slug' => $post->slug,
        ]);
        $message = $post->description;
        $image = url('/').get_post_image($this->id);
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
            'app_secret' => env('FACEBOOK_SECRET'),
            'default_access_token' => $user->token,
            'default_graph_version' => 'v18.0'
        ]);

        // Set the link and message data for the post
        $linkData = [
            'link' => $link,
            'message' => $message.' '.$tags,
        ];

        try {
            // Set the image URL and caption for the Instagram post
            $postToInstagramContainer = $fb->post("{$page->instagram_id}/media", [
                'image_url' => $image,
                'caption' => $linkData['message'] . ' ' . $linkData['link']
            ], $page->access_token);

            // Publish the Instagram post
            $publish = $fb->post("{$page->instagram_id}/media_publish", [
                'creation_id' => json_decode($postToInstagramContainer->getBody())->id
            ], $page->access_token);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error, display the error message
            echo 'Graph returned an error: ' . $e->getMessage();
            return false;
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues, display the error message
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            return false;
            exit;
        }

        // Redirect back to the previous page
        return $publish;
    }
}
