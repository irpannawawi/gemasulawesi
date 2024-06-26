<?php

namespace App\Http\Controllers;

use App\Jobs\PublishPost;
use App\Jobs\ShareJob;
use App\Models\Breakingnews;
use App\Models\Editorcoice;
use App\Models\Headlinerubrik;
use App\Models\Headlinewp;
use App\Models\Posts;
use App\Models\PushNotification;
use App\Models\Rubrik;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Spatie\Sitemap\Sitemap;

class EditorialController extends Controller
{
    public function create()
    {
        $data = [
            'rubriks' => Rubrik::get(),
        ];
        return view('editorial.create', $data);
    }

    public function edit($id)
    {
        $data = [
            'rubriks' => Rubrik::get(),
            'post' => Posts::find($id),
        ];
        return view('editorial.edit', $data);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts,title|max:140',
            'description' => 'required|max:140|min:100',
            'content' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Memastikan bahwa tag <img> ada dalam konten
                    if (!preg_match('/<img[^>]+>/i', $value)) {
                        $fail($attribute . ' harus mengandung setidaknya satu gambar.');
                    }
                },
            ],
        ], [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute melebihi batas karakter yang diizinkan',
            'min' => ':attribute kurang dari batas minimal karakter',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $article = $request->content;

        if ($article != null) {

            $dom = new DOMDocument;
            $dom->loadHTML($article, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            
            // Check if there is at least one <img> element
            if ($images->length > 0) {
                // Remove the first <img> element
                $firstImage = $images->item(0);
                $firstImage->parentNode->removeChild($firstImage);
            } else {
            }

            // Get the modified HTML
            $modifiedHtml = $dom->saveHTML();
            $article = $modifiedHtml;
        }
        
        
        $article = str_replace('"../../id/', '"'.env('APP_URL').'/id/', $article);
        $article = str_replace('"../id/', '"'.env('APP_URL').'/id/', $article);
        $article = str_replace('"../', '"'.env('APP_URL').'/', $article);

        // select status published, draft or scheduled
        $publishat = null;

        
        if ($request->is_draft == "1") {
            $status = 'draft';
        } elseif ($request->schedule == "1") {
            $status = 'scheduled';
        } else {
            $status = 'published';
            if($request->published_at == null){
                $publishat = date('Y-m-d H:i:s');
            }else{
                $publishat = Carbon::createFromDate($request->published_at);
            }
        }

        if (!empty($request->related)) {
            $related = json_encode($request->related);
        } else {
            $related = $request->related;
        }

        if (!empty($request->tags)) {
            $tags = json_encode($request->tags);
        } else {
            $tags = $request->tags;
        }

        if (!empty($request->sources)) {
            $sources = json_encode($request->sources);
        } else {
            $sources = $request->sources;
        }

        if (!empty($request->topics)) {
            $topics = json_encode($request->topics);
        } else {
            $topics = $request->topics;
        }



        $postData = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->rubrik,
            'description' => $request->description,
            'article' => $article,
            'allow_comment' => $request->allow_comment,
            'view_in_welcome_page' => $request->view_in_welcome_page,
            'author_id' => Auth::user()->id,
            'editor_id' => 1,
            'status' => $status,
            'related_articles' => $related,
            'tags' => $tags,
            'sources' => $sources,
            'topics' => $topics,
            'schedule_time' => Str::replace('T', ' ', $request->schedule_time),
            'published_at' => $publishat,
            'is_deleted' => $request->is_deleted,
            'post_image' => $request->post_image,

        ];
        // Insert the post into the database
        $newPost = Posts::create($postData);

        if ($newPost->status == 'scheduled') {
            // add update job
            $publishDate = str_replace('T', ' ', $request->schedule_time);
            $job = PublishPost::dispatch($newPost->post_id)->delay(Carbon::createFromFormat('Y-m-d H:i', $publishDate));
        }

        // add to sitemap
        $sitemap = Sitemap::create()->add($newPost);
        // Check if the post was successfully created
        if ($newPost) {
            // Redirect based on the post's status
            if ($status == 'scheduled') {
                return redirect()->route('editorial.scheduled')->with('success', 'Post has been created');
            } else {
                if ($request->is_draft != 1) {
                    ShareJob::dispatch($newPost->post_id)->delay(Carbon::now()->addMinutes(1));
                }
                return redirect()->route($request->is_draft == 1 ? 'editorial.draft' : 'editorial.published')->with('success', 'Post has been created');
            }
        } else {
            // Handle the case where post creation fails
            return back()->withInput()->withErrors(['error' => 'Failed to create the post.']);
        }
    }

    public function update(Request $request, $id)
    {
        cache()->forget('posts' . $id);
        $request->validate([
            'title' => 'required|max:140',
            'description' => 'required|max:140|min:100',
            'content' => 'required',
        ]);

        $post = Posts::find($id);

        $article = $request->content;
        if ($article != null) {

            $dom = new DOMDocument;
            $dom->loadHTML($article, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            // Check if there is at least one <img> element
            if ($images->length > 0) {
                // Remove the first <img> element
                $firstImage = $images->item(0);
                $firstImage->parentNode->removeChild($firstImage);
            }

            // Get the modified HTML
            $modifiedHtml = $dom->saveHTML();
            $article = $modifiedHtml;
        }
        $article = str_replace('"../../id/', '"https://www.gemasulawesi.com/id/', $article);
        $article = str_replace('"../id/', '"https://www.gemasulawesi.com/id/', $article);
        $article = str_replace('"../../', '"https://www.gemasulawesi.com/', $article);
        $article = str_replace('"../', '"'.env('APP_URL').'/', $article);
        
        // select status published, draft or scheduled
        if ($request->is_draft == "1") {
            $status = 'draft';
        } elseif ($request->schedule == "1") {
            $status = 'scheduled';
        } else {
            $status = 'published';
        }

        if (!empty($request->related)) {
            $related = json_encode($request->related);
        } else {
            $related = $request->related;
        }
        if (!empty($request->tags)) {
            $tags = json_encode($request->tags);
        } else {
            $tags = $request->tags;
        }
        if (!empty($request->sources)) {
            $sources = json_encode($request->sources);
        } else {
            $sources = $request->sources;
        }
        if (!empty($request->topics)) {
            $topics = json_encode($request->topics);
        } else {
            $topics = $request->topics;
        }

        if($request->published_at == null)
        {
            $published_at = date('Y-m-d H:i');
        }else{
            $dt = Str::replace('T', ' ', $request->published_at); 
            $published_at = Carbon::createFromDate(Str::replace('T', ' ', $request->published_at));
        }

        $post->title = $request->title;
        // $post->slug = Str::slug($request->title);
        $post->category = $request->rubrik;
        $post->description = $request->description;
        $post->article = $article;
        $post->allow_comment = $request->allow_comment;
        $post->view_in_welcome_page = $request->view_in_welcome_page;
        $post->status = $status;
        $post->related_articles = $related;
        $post->tags = $tags;
        $post->sources = $sources;
        $post->topics = $topics;
        $post->schedule_time = $request->schedule_time;
        $post->is_deleted = $request->is_deleted;
        $post->post_image = $request->post_image;
        $post->published_at = $published_at;

        // save the post into the database

        // Check if the post was successfully created
        if ($post->save()) {
            // clear cache
            Cache::forget('post' . $post->post_id);
            if ($post->status == 'scheduled') {
                // add update job
                $publishDate = str_replace('T', ' ', $request->schedule_time);
                $job = PublishPost::dispatch($post->post_id)->delay(Carbon::createFromFormat('Y-m-d H:i', $publishDate));
            }

            // Redirect based on the post's status
            if ($status == 'scheduled') {
                return redirect()->route('editorial.scheduled')->with('success', 'Post has been updated');
            } else {
                return redirect()->route($request->is_draft == 1 ? 'editorial.draft' : 'editorial.published')->with('success', 'Post has been updated');
            }
        } else {
            // Handle the case where post creation fails
            return back()->withInput()->withErrors(['error' => 'Failed to create the post.']);
        }

        // dd($request->all());
    }

    public function modal_related(Request $request)
    {
        $posts = $this->getPost($request, 'published');
        $data['posts'] = $posts->paginate(20);
        return view('editorial.components.modal_related', $data);
    }

    public function draft(Request $request)
    {
        $posts = $this->getPost($request, 'draft');
        // dd(request()->all());
        $data['posts'] = $posts->paginate(20);
        return view('editorial.draft', $data);
    }


    public function scheduled(Request $request)

    {
        $posts = $this->getPost($request, 'scheduled');
        $data['posts'] = $posts->paginate(20);

        return view('editorial.scheduled', $data);
    }

    public function trash(Request $request)
    {
        $posts = $this->getPost($request, 'trash');

        $data['posts'] = $posts->paginate(20);
        return view('editorial.trash', $data);
    }

    public function empty_trash(Request $request)
    {
        Posts::where('status', 'trash')->delete();
        return redirect()->route('editorial.trash');
    }

    public function published(Request $request)
    {
        $posts = $this->getPost($request, 'published');

        $data['posts'] = $posts->paginate(20);

        return view('editorial.published', $data);
    }


    public function api_create(Request $request)
    {
        $postData = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'description' => $request->description,
            'article' => $request->article,
            'allow_comment' => false,
            'view_in_welcome_page' => false,
            'author_id' => $request->author_id,
            'editor_id' => $request->editor_id,
            'status' => 'published',
            'related_articles' => null,
            'tags' => $request->tags,
            'topics' => null,
            'schedule_time' => $request->schedule_time,
            'published_at' => $request->published_at,
            'is_deleted' => $request->is_deleted,
            'post_image' => $request->post_image,
            'origin_id' => $request->origin_id,
        ];

        // dd($postData);

        $res = Posts::create($postData);

        // die;
        if ($res) {
            return response()->json([
                'status' => True,
                'data' => $res
            ]);
        } else {
            return response()->json([
                'status' => False
            ]);
        }
    }

    public function delete($id)
    {
        // Find the post by its ID
        $post = Posts::find($id);

        // Check if the post exists
        if (!$post) {
            return back()->withInput()->withErrors(['error' => 'Post not found.']);
        }

        // Perform any additional checks or authorization if needed

        // Soft delete the post
        $post->status = 'trash';
        $post->save();

        // Redirect to the appropriate route based on post status
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }

    public function restore($id)
    {
        // Find the post by its ID
        $post = Posts::find($id);

        // Check if the post exists
        if (!$post) {
            return back()->withInput()->withErrors(['error' => 'Post not found.']);
        }

        // Perform any additional checks or authorization if needed

        // restore the post
        $post->status = 'draft';
        $post->save();

        // Redirect to the appropriate route based on post status
        return redirect()->back()->with('success', 'Post restored successfully.');
    }

    public function hardDelete($id)
    {
        // Find the post by its ID
        $post = Posts::find($id);

        // Check if the post exists
        if (!$post) {
            return back()->withInput()->withErrors(['error' => 'Post not found.']);
        }

        Headlinewp::where('post_id', $id)->update(['post_id' => 0]);
        Headlinerubrik::where('post_id', $id)->delete();
        PushNotification::where('post_id', $id)->delete();
        Editorcoice::where('post_id', $id)->delete();
        Breakingnews::where('post_id', $id)->delete();
        $post->delete();

        // Redirect to the appropriate route based on post status
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }

    public function getPost($request, $status)
    {
        $q = $request->q;
        $data['q'] = $q;

        // chek if sorted
        $posts = Posts::where('status', $status);

        if (!empty($request->sort_by)) {
            $posts = $posts->orderBy($request->sort_by, $request->order);
        } else {
            $posts = $posts->orderBy('published_at', 'DESC');
        }
        // chek if has query string
        if (!empty($q)) {
            $posts = $posts->where('title', 'LIKE', '%' . $q . '%');
        }
        // chek if filtered category
        if (!empty($request->rubrik)) {
            $posts = $posts->where('category', '=', $request->rubrik);
        }
        // chek if filtered author

        if (!empty($request->author)) {
            $posts = $posts->where('author_id', '=', $request->author);
        }
        // chek if filtered date
        if (!empty($request->dates)) {
            $dates = explode(' - ', $request->dates);
            $start_date = Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d 00:00:00');
            $end_date = Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d 23:59:59');
            $posts = $posts->whereBetween('published_at', [$start_date, $end_date]);
        }

        return $posts;
    }
}
