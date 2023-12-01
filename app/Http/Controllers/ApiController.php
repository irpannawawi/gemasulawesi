<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Image;
use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ApiController extends Controller
{
    public function insert(Request $request)
    {
        $articleData =  json_decode(json_encode($request->all()), FALSE);
        foreach ($articleData as $article) {
            $response[$article->id] = [];
            // 1. check post @post id
            if (Posts::where('origin_id', $article->id)->count() > 0) {
                $response[$article->id] =  ['status'=>'Has post'];
            } else {
                // 2. check rubrik @article
                $rubrikId = $article->categories[0];
                $rubrik = Rubrik::where('rubrik_id', $rubrikId)->get()->count();
                if ($rubrik < 1) {
                    // create rubrik
                    $catUrl = 'https://gemasulawesi.com/wp-json/wp/v2/categories/' . $rubrikId;
                    $cat = Http::get($catUrl)->object();
                    $rubrik = Rubrik::create(['rubrik_id' => $rubrikId, 'rubrik_name' => $cat->name]);
                } else {
                    // has rubrik
                    // 3. check tags @article
                    foreach ($article->tags as $tag_id) {
                        if (Tags::where(['tag_id' => $tag_id])->count() < 1) {
                            $tagUrl = 'https://gemasulawesi.com/wp-json/wp/v2/tags/' . $tag_id;
                            $tag = Http::get($tagUrl)->object();
                            Tags::create(['tag_id' => $tag_id, 'tag_name' => $tag->name]);
                        }
                    } //3. 

                    // upload images
                    $media_url = "https://www.gemasulawesi.com/wp-json/wp/v2/media/".$article->featured_media;
                    $media = Http::get($media_url)->object();
                    $file_name = $media->slug.'.'. explode('/', $media->mime_type)[1];
                    $res = Storage::put('public/photos/' . $file_name, file_get_contents($media->source_url));
                    // insert asset        
                    $asset = Asset::create(['file_name' => $file_name]);

                    // insert photo  
                    // insert image details
                    $imageDetails = [
                        'asset_id' => $asset->asset_id,
                        'uploader_id' => 1,
                        'image_id' => $media->id,
                        'author' => $media->author,
                        'caption' => $media->caption->rendered,

                    ];
                    $res = Image::create($imageDetails); // 4. 

                    // 5. create post
                    $tags = '[';
                    foreach ($article->tags as $tag_id){
                        $tags .= '"'.$tag_id.'"';
                    }
                    $tags .=']';

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
                        'post_image' => $file_name,
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
                            'data'=>'Gagal menambah post'
                        ];
                    }
                } //2. 

            } // 1.

        }// loop

        return response()->json($response);
    }
}
