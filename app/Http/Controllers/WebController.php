<?php

namespace App\Http\Controllers;

use App\Models\Editorcoice;
use App\Models\Posts;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(): View
    {
        $data['editorCohice'] = Editorcoice::get();
        return view('frontend.web', $data);
    }

    public function singlePost($rubrik_name, $post_id): View
    {
        $data['post'] = Posts::find($post_id);
        return view('frontend.singlepost', $data);
    }
}
