<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function index(Request $request)
    {
        $data['list_video'] = Video::orderBy('video_id', 'DESC')->paginate(20);
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
        $description = $request->description;
        $video = Video::find($request->video_id);

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
