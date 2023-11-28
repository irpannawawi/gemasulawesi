<?php

namespace App\Http\Controllers;

use App\Jobs\PublishPost;
use App\Models\Posts;
use App\Models\Rubrik;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Carbon;

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
        
        $article = $request->content;
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

        // select status published, draft or scheduled
        if($request->is_draft=="1"){
            $status = 'draft';
        }elseif($request->schedule=="1"){
            $status = 'scheduled';
        }else{
            $status = 'published';
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
            'editor_id' => Auth::user()->id,
            'status' => $status,
            'related_articles' => json_encode($request->related),
            'tags' => json_encode($request->tags),
            'topics' => json_encode($request->topics),
            'schedule_time' => $request->schedule_time,
            'published_at' => $request->published_at,
            'is_deleted' => $request->is_deleted,
            'post_image' => $request->post_image,

        ];
        
        // Insert the post into the database
        $newPost = Posts::create($postData);
        
        if ($newPost->status=='scheduled') {
            // add update job
            $publishDate = str_replace('T',' ', $request->schedule_time);
            $job = PublishPost::dispatch($newPost->post_id)->delay(Carbon::createFromFormat('Y-m-d H:i', $publishDate));
        }

        // Check if the post was successfully created
        if ($newPost) {
            // Redirect based on the post's status
            if($status=='scheduled'){
                return redirect()->route('editorial.scheduled')->with('success', 'Post has been created');
            }else{
                return redirect()->route($request->is_draft == 1 ? 'editorial.draft' : 'editorial.published')->with('success', 'Post has been created');
            }
        } else {
            // Handle the case where post creation fails
            return back()->withInput()->withErrors(['error' => 'Failed to create the post.']);
        }
    }

    public function update(Request $request, $id)
    {
        $post = Posts::find($id);

        $article = $request->content;
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

            $post->title = $request->title;
            $post->slug = Str::slug($request->title);
            $post->category = $request->rubrik;
            $post->description = $request->description;
            $post->article = $article;
            $post->allow_comment = $request->allow_comment;
            $post->view_in_welcome_page = $request->view_in_welcome_page;
            $post->author_id = Auth::user()->id;
            $post->editor_id = Auth::user()->id;
            $post->status = $request->is_draft==1?'draft':'published';
            $post->related_articles = json_encode($request->related);
            $post->tags = json_encode($request->tags);
            $post->topics = json_encode($request->topics);
            $post->schedule_time = $request->schedule_time;
            $post->published_at = $request->published_at;
            $post->is_deleted = $request->is_deleted;
            $post->post_image = $request->post_image;

        if ($post->save()) {
            if($request->is_draft==1){
                return redirect()->route('editorial.draft');
            }else{
                return redirect()->route('editorial.published');
            }
        }
        // dd($request->all());
    }

    public function modal_related()
    {
        $data['posts'] = Posts::where('status', 'published')->orderBy('created_at', 'DESC')->paginate(20);
        return view('editorial.components.modal_related', $data);
    }

    public function draft()
    {
        $data['posts'] = Posts::where('status', 'draft')->orderBy('created_at', 'DESC')->paginate(20);
        return view('editorial.draft', $data);
    } 
    
    
    public function scheduled()
    {
        $data['posts'] = Posts::where('status', 'scheduled')->orderBy('created_at', 'DESC')->paginate(20);
        return view('editorial.scheduled', $data);
    } 
    
    public function trash()
    {
        $data['posts'] = Posts::where('status', 'trash')->orderBy('created_at', 'DESC')->paginate(20);
        return view('editorial.trash', $data);
    }

    public function published()
    {
        $data['posts'] = Posts::where('status', 'published')->orderBy('created_at', 'DESC')->paginate(20);
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

    public function delete($id){
        // Find the post by its ID
        $post = Posts::find($id);

        // Check if the post exists
        if (!$post) {
            return back()->withInput()->withErrors(['error' => 'Post not found.']);
        }

        // Perform any additional checks or authorization if needed

        // Soft delete the post
        $post->status='trash';
        $post->save();

        // Redirect to the appropriate route based on post status
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }

    public function hardDelete($id){
        // Find the post by its ID
        $post = Posts::find($id);

        // Check if the post exists
        if (!$post) {
            return back()->withInput()->withErrors(['error' => 'Post not found.']);
        }

        $post->delete();

        // Redirect to the appropriate route based on post status
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}
