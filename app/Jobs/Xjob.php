<?php

namespace App\Jobs;
use App\Models\FbAuth;
use App\Models\FbPages;
use App\Models\Posts;
use App\Models\Tags;
use App\Models\XAuth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Noweh\TwitterApi\Client;
use Illuminate\Support\Str;
class Xjob implements ShouldQueue
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
        $tag_list = ' ';
        if ($post->tags != null and $post->tags != 'null') {
            foreach (json_decode($post->tags) as $tags) {
                $tag = Tags::find($tags);
                $tag_name = str_replace(' ', '', $tag->tag_name);
                $tag_list .= "#{$tag_name} ";
            }
        }

        $this->shareX($message, $link, $tag_list);
    }

public function shareX($message, $link, $tags)
{
    $xCred = XAuth::first();
    
    $twitterSettings = [
        'account_id' => $xCred->id,
        'access_token' => $xCred->token,
        'access_token_secret' => $xCred->token_secret,
        'consumer_key' => env('X_CLIENT_ID'),
        'consumer_secret' => env('X_CLIENT_SECRET'),
        'bearer_token' => env('X_BEARER_TOKEN')
    ];
    
    $client = new Client($twitterSettings);
    $tweet = $client->tweet()->create();
    $tweet->performRequest([
        'text' => $message.' '.$tags.' '.$link
    ]);
    
    return redirect()->back();
}
}
