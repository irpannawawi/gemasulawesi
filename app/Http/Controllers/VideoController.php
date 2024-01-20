<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{

    public function index(Request $request)
    {
        $uploader = $request->uploader;
        $q = $request->q;
        $video = Video::orderBy('video_id', 'DESC');
        if($uploader!=''){
            $video->where('uploader_id', $uploader);
        }

        if($q!=''){
            $video->where('title', 'like', '%'.$q.'%');
            $video->where('description', 'like', '%'.$q.'%');
        }
        $data['list_video'] = $video->paginate(20);
        $data['q'] = $q;
        $data['uploader'] = $uploader;
        return view('assets.video.view', $data);
    }

    public function add(Request $request)
    {
        return view('assets.video.add');
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return view('assets.video.edit', ['video' => $video]);
    }

    public function insert(Request $request)
    {
        $user_id = $request->uploader_id;
        $url = $request->input_url;
        $value = getYoutubeData($url)->snippet;
        $title = $value->title;
        $description = $value->description;
        
        $dataVideo = [
            'uploader_id' => $user_id,
            'url' => $url,
            'title' => $title,
            // 'slug' => Str::slug($title),
            'description' => $description
        ];
        $res = Video::create($dataVideo);
        if ($res) {
            return redirect()->route('assets.video.index');
        }
    }

    public function update(Request $request)
    {

        $title = $request->title;
        // $slug = Str::slug($request->title);
        $description = $request->description;
        $video = Video::find($request->video_id);

        // $video->slug = $slug;
        $video->title = $title;
        $video->description = $description;
        if ($video->save()) {
            return redirect()->route('assets.video.index');
        }
    }

    public function delete($id)
    {
        Video::where('video_id', $id)->delete();
        return redirect()->route('assets.video.index');
    }
}
