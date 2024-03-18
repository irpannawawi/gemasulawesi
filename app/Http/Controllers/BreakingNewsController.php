<?php

namespace App\Http\Controllers;

use App\Models\Breakingnews;
use App\Models\Posts;
use Carbon\Carbon;
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
       $posts = $this->getPost($request, 'published');
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

    
    private function getPost($request, $status)
    {
        $q = $request->q;
        $data['q'] = $q;

        // chek if sorted
        $posts = Posts::where('status', $status);

        if (!empty($request->sort_by)) {
            $posts = $posts->orderBy( $request->sort_by, $request->order);
        }else{
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
