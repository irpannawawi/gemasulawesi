<?php

namespace App\Jobs;

use App\Models\LinkedinAuth;
use App\Models\Posts;
use App\Models\Tags;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Linkedinjob implements ShouldQueue
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
        
        $title = $post->title;
        $image = url('/').get_post_image($post->post_id);
        $description = $post->description;
        $tag_list = '';
        if ($post->tags != null and $post->tags != 'null') {
            foreach (json_decode($post->tags) as $tags) {
                $tag = Tags::find($tags);
                $tag_name = str_replace(' ', '', $tag->tag_name);
                $tag_list .= " #{$tag_name} ";
            }
        }
        $res = $this->share($title, $description, $image, $tag_list, $link);
        DB::table('failed_jobs')->truncate();
    }

    public function share($title, $description, $image, $tag_list, $url)
    {
        $user = LinkedinAuth::first();
        
        $http = Http::withToken($user->token)->get('https://api.linkedin.com/v2/userinfo');
        $prson = $http->object();
        Cache::put('linkedin', $prson, 3600);
               // create post
        $postUrl = 'https://api.linkedin.com/v2/ugcPosts';
        $body = [
            "author" => "urn:li:person:{$prson->sub}",
            "lifecycleState" => "PUBLISHED",
            "specificContent" => [
                "com.linkedin.ugc.ShareContent" => [
                    "shareCommentary" => [
                        "text" => $description .' '. $tag_list .' '. $url
                    ],
                    "shareMediaCategory" => "ARTICLE",
                    "media" => [
                        [
                            "status" => "READY",
                            "description" => [
                                "text" => $description
                            ],
                            "originalUrl" => $url,
                            "thumbnails"=> [
                                ["url"=> $image],
                            ],
                            "title" => [
                                "text" => $title
                            ]
                        ]
                    ]
                ]
            ],
            "visibility" => [
                "com.linkedin.ugc.MemberNetworkVisibility" => "PUBLIC"
            ]
        ];
        $body = json_encode($body, JSON_UNESCAPED_SLASHES);
        $postHttp = Http::withHeader('X-Restli-Protocol-Version', '2.0.0')
            ->withBody($body)
            ->withToken($user->token)
            ->post($postUrl);
        return $postHttp->object();
    }
}
