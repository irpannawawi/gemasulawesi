<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Galeri;
use App\Models\Image;
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
        $data['gallery'] = Galeri::orderBy('galery_id', 'desc')->get();
        return view('frontend.gallery', $data);
    }

    public function galerydetail($id): View
    {
        $data['collections'] = Collection::where('galery_id', $id)->orderBy('collection_id', 'desc')->get();
        $data['galery'] = Galeri::find($id);
        $data['photos'] = Image::orderBy('image_id', 'DESC')->paginate(20);
        $data['videos'] = Video::orderBy('video_id', 'DESC')->paginate(20);

        $data['pagination'] = Galeri::orderBy('galery_id', 'desc')
            ->paginate(10);
        $data['galeryTerkini'] = $data['pagination'];

        return view('frontend.gallerydetail', $data);
    }
}
