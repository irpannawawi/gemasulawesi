<?php

namespace App\Http\Controllers;

use App\Models\Breakingnews;
use App\Models\Posts;
use Illuminate\Http\Request;

class BreakingNewsController extends Controller
{
    public function index()
    {
        $data['breakingNews'] = Breakingnews::orderBy('breaking_news_id', 'desc')->with('post', )->paginate(20);
        return view('breaking-news.index', $data);
    }

    public function insert()
    {
        // $data['posts'] = Posts::orderBy('post_id', 'desc')->where('status', 'published')->get();
        return view('breaking-news.add');
    }

    
    public function browse(Request $request)
    {
        $q = $request->q;
        
        $data['q'] = $q;
        $posts = Posts::where('status', 'published')->orderBy('published_at', 'DESC');
        if(!empty($q)){
            $posts = $posts->where('title', 'LIKE', '%' . $q . '%');
        }
        if(!empty($request->rubrik)){
            $posts = $posts->where('category', '=', $request->rubrik);
        }
        $data['posts'] = $posts->paginate(20);
        return view('breaking-news.browse_article', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'post_id'=>$request->post_id,
            'title'=>$request->title,
        ];

        if(Breakingnews::create($data))
        {
            return redirect('breakingNews')->with('message', 'Berhasil menambah breaking news');
        }

    }
    
    
    public function edit($id)
    {
        $data['posts'] = Posts::orderBy('post_id', 'desc')->where('status', 'published')->get();
        $data['news'] = Breakingnews::find($id);
        return view('breaking-news.update', $data);
    }
    
    public function update(Request $request, $id)
    {
        $news = Breakingnews::find($id);
        $news->post_id = $request->post_id;
        $news->title = $request->title;

        if($news->save())
        {
            return redirect('breakingNews')->with('message', 'Berhasil merubah breaking news');
        }
        
    }

    
    public function delete($id)
    {
        if(Breakingnews::where('breaking_news_id', $id)->delete())
        {
            return redirect('breakingNews')->with('message', 'Berhasil menghapus breaking news');
        }
        
    }
}
