<?php

namespace App\Http\Controllers;

use App\Models\Editorcoice;
use App\Models\Headlinerubrik;
use App\Models\Headlinewp;
use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Tags;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(): View
    {
        $data['editorCohice'] = Editorcoice::get();
        $data['headlineWp'] = Headlinewp::get();
        $data['topikKhusus'] = Topic::get();

        // posts 1-20
        $data['paginatedPost'] = Posts::orderBy('created_at', 'DESC')
            ->where('status', 'published')
            ->paginate(20);
        $data['beritaTerkini'] = $data['paginatedPost']->split(2);

        // dd($data['beritaTerkini']);
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
        $data['topikKhusus'] = Topic::get();

        // posts 1-20
        $data['paginatedPost'] = Posts::orderBy('created_at', 'DESC')
            ->where(['status' => 'published', 'category' => $rubrik->rubrik_id])
            ->paginate(20);
        $data['beritaTerkini'] = $data['paginatedPost']->split(2);
        return view('frontend.category', $data);
    }

    public function tags($tag_name): View
    {
        $tag_id = Tags::where('tag_name', $tag_name)->get()[0]->tag_id;

        $data['tag_name'] = $tag_name;
        $data['topikKhusus'] = Topic::get();

        // posts 1-20
        $data['paginatedPost'] = Posts::orderBy('created_at', 'DESC')
            ->where(
                [
                    ['status', '=', 'published'],
                    ['tags', 'like', '%"' . $tag_id . '"%']
                ]
            )
            ->paginate(20);
        $data['beritaTerkini'] = $data['paginatedPost']->split(2);
        return view('frontend.tags', $data);
    }
}
