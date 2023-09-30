<?php

namespace App\Http\Controllers;

use App\Models\Editorcoice;
use App\Models\Headlinerubrik;
use App\Models\Headlinewp;
use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(): View
    {
        $data['editorCohice'] = Editorcoice::get();
        $data['headlineWp'] = Headlinewp::get();
        $data['beritaTerkini'] = Posts::orderBy('cretaed_at','DESC')->where('status','published')->get();
        $data['topikKhusus'] = Topic::get();

        return view('frontend.web', $data);
    }
    public function showCategory(): View
    {
        $data['editorCohice'] = Editorcoice::get();
        return view('frontend.web', $data);
    }

    public function singlePost($rubrik_name, $post_id, $slug): View
    {
        $data['post'] = Posts::find($post_id);
        return view('frontend.singlepost', $data);
    }

    public function category($rubrik_name): View
    {
        $rubrik = Rubrik::where('rubrik_name', $rubrik_name)->get()[0];
        $data['rubrik_name'] = $rubrik_name;
        $data['headlineRubrik'] = Headlinerubrik::where('rubrik_id', $rubrik->rubrik_id)->get()[0];
        $data['beritaTerkini'] = Posts::orderBy('created_at', 'DESC')->where(['status'=>'published', 'category'=>$rubrik->rubrik_id])->get();
        $data['topikKhusus'] = Topic::get();
        return view('frontend.category', $data);
    }
}
