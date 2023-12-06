<?php

namespace App\Jobs;

use App\Models\Asset;
use App\Models\Image;
use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Tags;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

use PDO;

class MigrateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $article;
    public function __construct($article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->article as $article) {
            $response[$article->id] = [];
            // 1. check post @post id 
            if (Posts::where('origin_id', $article->id)->count() > 0) {
                $response[$article->id] =  ['status' => 'Has post'];
            } else {
                // 2. check rubrik @article
                // cek jika rubrik 2 maka ambil ke 2
                if (count($article->categories) > 1) {
                    $rubrikId = $article->categories[1];
                } else {
                    $rubrikId = $article->categories[0];
                }

                $cl = new Client();
                $rubrik = Rubrik::where('rubrik_id', $rubrikId)->get()->count();
                if ($rubrik < 1) {
                    // create rubrik
                    $catUrl = 'https://gemasulawesi.com/wp-json/wp/v2/categories/' . $rubrikId;
                    // $cat = json_decode($cl->get($catUrl)->getBody()->getContents());
                    $cat = json_decode($cl->get($catUrl)->getBody()->getContents());
                    $rubrik = Rubrik::create(['rubrik_id' => $rubrikId, 'rubrik_name' => $cat->name]);
                } else {
                    // has rubrik
                    // 3. check tags @article
                    foreach ($article->tags as $tag_id) {
                        if (Tags::where(['tag_id' => $tag_id])->count() < 1) {
                            $tagUrl = 'https://gemasulawesi.com/wp-json/wp/v2/tags/' . $tag_id;
                            $tag = json_decode($cl->get($tagUrl)->getBody()->getContents());
                            Tags::create(['tag_id' => $tag_id, 'tag_name' => $tag->name]);
                        }
                    } //3. 

                    // upload images
                    $media_url = "https://www.gemasulawesi.com/wp-json/wp/v2/media/" . $article->featured_media;
                    $media = json_decode($cl->get($media_url)->getBody()->getContents());
                    $file_name = $media->slug . '.' . explode('/', $media->mime_type)[1];
                    $res = Storage::put('public/photos/' . $file_name, file_get_contents($media->source_url));
                    // insert asset        
                    $asset = Asset::updateOrCreate(['file_name' => $file_name], ['file_name' => $file_name]);

                    // insert photo  
                    // insert image details
                    $imageDetails = [
                        'asset_id' => $asset->asset_id,
                        'uploader_id' => 1,
                        'image_id' => $media->id,
                        'author' => $media->author,
                        'caption' => $media->caption->rendered,

                    ];
                    $image = Image::updateOrCreate(['image_id' => $imageDetails['image_id']], $imageDetails); // 4. 

                    // 5. create post
                    $tags = '[';
                    foreach ($article->tags as $tag_id) {
                        $tags .= '"' . $tag_id . '"';
                    }
                    $tags .= ']';

                    $postData = [
                        'title' => $article->title->rendered,
                        'slug' => $article->slug,
                        'category' => $rubrikId,
                        'description' => $article->yoast_head_json->twitter_description,
                        'article' => $article->content->rendered,
                        'allow_comment' => false,
                        'view_in_welcome_page' => false,
                        'author_id' => $article->author,
                        'editor_id' => 1,
                        'status' => 'published',
                        'related_articles' => null,
                        'tags' => json_encode($article->tags),
                        'topics' => null,
                        'published_at' => str_replace('T', ' ', $article->date),
                        'created_at' => str_replace('T', ' ', $article->date),
                        'post_image' => $image->image_id,
                        'origin_id' => $article->id,
                    ];

                    $res = Posts::create($postData);

                    if ($res) {
                        $response[$article->id] = [
                            'status' => True,
                            'data' => 'Berhasil'
                        ];
                    } else {
                        $response[$article->id] = [
                            'status' => False,
                            'data' => 'Gagal menambah post'
                        ];
                    }
                } //2. 

            } // 1.

        } // loop
    }
}
