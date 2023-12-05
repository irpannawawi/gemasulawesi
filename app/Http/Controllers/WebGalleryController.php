<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Galeri;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;

class WebGalleryController extends Controller
{
    public function gallery()
    {
        $data['pagination'] = Galeri::orderBy('galery_id', 'desc')
            ->paginate(10);
        $data['galery'] = $data['pagination'];
        return view('frontend.gallery', $data);
    }

    // public function videtail($video_id): View
    // {
    //     $logResult = VisitLog::save(request()->all());

    //     if (is_array($logResult) && isset($logResult['type']) && $logResult['type'] == 'create') {
    //         $video = Video::find($video_id);
    //         $video->visit += 1;
    //         $video->save();
    //     }

    //     $video = Video::find($video_id);
    //     $data['paginatedVideo'] = Video::orderBy('created_at', 'DESC')
    //         ->limit(10)->get();
    //     $data['videoTerkini'] = $data['paginatedVideo'];

    //     $data['video'] = $video;
    //     return view('frontend.videodetail', $data);
    // }
}
