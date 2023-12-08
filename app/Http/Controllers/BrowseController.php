<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Posts;
use App\Models\Topic;
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
        $data['posts'] = Posts::orderBy('published_at', 'DESC')->where([
            ['category', 'like', '%'.$rubrik.'%'],
            ['title', 'like', '%'.$q.'%']
        ])->paginate(20);
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
}
