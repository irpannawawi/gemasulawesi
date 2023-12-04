<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;

class WebGalleryController extends Controller
{
    public function video()
    {
        $data['videoTerkini'] = Video::orderBy('updated_at', 'DESC')->first();
        $data['paginateVideo'] = Video::orderBy('updated_at', 'DESC')->where('video_id', '!=', $data['videoTerkini']->video_id)->paginate(20);
        $data['videoLainnya'] = $data['paginateVideo'];

        return view('frontend.video', $data);
    }

    public function videtail($video_id): View
    {
        // visitor counter
        // jika ip sudah mengunjungi do nothing
        $logResult = VisitLog::save(request()->all());

        if (is_array($logResult) && isset($logResult['type']) && $logResult['type'] == 'create') {
            $video = Video::find($video_id);
            $video->visit += 1;
            $video->save();
        }

        $video = Video::find($video_id);
        $data['paginatedVideo'] = Video::orderBy('created_at', 'DESC')
            ->limit(10)->get();
        $data['videoTerkini'] = $data['paginatedVideo'];

        $data['video'] = $video;
        return view('frontend.videodetail', $data);
    }

    public function image()
    {
        return view('frontend.image');
    }
}
