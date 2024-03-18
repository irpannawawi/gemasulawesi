<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Posts;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    //

    public function browseImage() {
        $data['photos'] = Image::get();
        return view('browse', $data);
    }

    public function browseBacaJuga(Request $request) {
        $q = $request->q;
        $rubrik = $request->rubrik;
        if($rubrik==null)
        {
            $rubrik='';
        }
        $data['rubrikId'] = $rubrik;
        $data['q'] = $q;
        $posts = $this->getPost($request, 'published');
        $data['posts'] = $posts->paginate(20);
        return view('browse_baca_juga', $data);
    }

    public function select2related(Request $request)
    {
        $query = $request->q;
        $related = Posts::where('title', 'LIKE', '%'.$query.'%')->where('status', 'published')->limit(10)->get();
        return response()->json(['posts' => $related]);
    }

    
    public function select2topic(Request $request)
    {
        $query = $request->q;
        $topics = Topic::where('topic_name', 'LIKE', '%'.$query.'%')->orWhere('topic_description', 'LIKE', '%'.$query.'%')->get();
        return response()->json(['topics' => $topics]);
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
