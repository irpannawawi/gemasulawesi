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
use Illuminate\Support\Facades\Http;
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
        $image = get_post_image($this->id);

        $title = $post->title;
        $description = $post->description;
        $tag_list = '';
        if ($post->tags != null and $post->tags != 'null') {
            foreach (json_decode($post->tags) as $tags) {
                $tag = Tags::find($tags);
                $tag_name = str_replace(' ', '', $tag->tag_name);
                $tag_list .= " #{$tag_name} ";
            }
        }

        $this->share($description, $title, $tag_list, $link, $image);
    }

    public function share($title, $description, $tag_list, $url, $image)
    {
        $user = LinkedinAuth::first();

        $http = Http::withToken($user->token)->get('https://api.linkedin.com/v2/userinfo');
        $prson = $http->object();
        // handle media
        $mediaUrl = 'https://api.linkedin.com/v2/assets?action=registerUpload';
        $bodyMedia = [
            "registerUploadRequest" => [
                "recipes" => [
                    "urn:li:digitalmediaRecipe:feedshare-image"
                ],
                "owner" => "urn:li:person:{$prson->sub}",
                "serviceRelationships" => [
                    [
                        "relationshipType" => "OWNER",
                        "identifier" => "urn:li:userGeneratedContent"
                    ]
                ]
            ]
        ];
        $bodyMedia = json_encode($bodyMedia, JSON_UNESCAPED_SLASHES);
        $mediaResponse = Http::withToken($user->token)
            ->withBody($bodyMedia, 'application/json')
            ->withHeader('X-Restli-Protocol-Version', '2.0.0')
            ->post($mediaUrl)->object()->value;
        $uploadUrl = $mediaResponse->uploadMechanism->uploadUrl;

        // upload image
        Http::post($uploadUrl, ['file' => fopen(public_path($image), 'r')]);

        // create post
        $postUrl = 'https://api.linkedin.com/v2/ugcPosts';
        $body = [
            "author" => "urn:li:person:{$prson->sub}",
            "lifecycleState" => "PUBLISHED",
            "specificContent" => [
                "com.linkedin.ugc.ShareContent" => [
                    "shareCommentary" => [
                        "text" => $description . $tag_list
                    ],
                    "shareMediaCategory" => "ARTICLE",
                    "media" => [
                        [
                            "status" => "READY",
                            "description" => [
                                "text" => $description
                            ],
                            "media" => $mediaResponse->asset,
                            "originalUrl" => $url,
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
