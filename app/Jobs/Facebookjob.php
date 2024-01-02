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
class Facebookjob implements ShouldQueue
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
        $cachedPost = cache('cahcedPost' . $this->id);
        if(!$cachedPost){
            $post = Posts::find($this->id);
            $cachedPost = cache('cahcedPost' . $this->id, $post, 60*60*24);
        }else{
            $post = $cachedPost;
        }

        $link = route('singlePost', [
            'rubrik' => Str::slug($post->rubrik->rubrik_name),
            'post_id' => $post->post_id,
            'slug' => $post->slug,
        ]);
        $message = $post->description;
        $tag_list = '';
        if ($post->tags != null and $post->tags != 'null') {
            foreach (json_decode($post->tags) as $tags) {
                $tag = Tags::find($tags);
                $tag_name = str_replace(' ', '', $tag->tag_name);
                $tag_list .= " #{$tag_name} ";
            }
        }

        $this->sharePostToFacebook($message, $link, $tag_list);
    }

    public function sharePostToFacebook($message,  $link, $tags)
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


            // Post the link data to the Facebook page feed
            $publish =  $fb->post("{$page->id}/feed", $linkData, $page->access_token);

    }
}
