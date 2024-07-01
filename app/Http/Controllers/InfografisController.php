<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Galeri;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function index(){
        $data['collections'] = Collection::where('galery_id', 2)->orderBy('collection_id', 'desc')->get();
        $data['galery'] = Galeri::find(2);
        $data['photos'] = Image::orderBy('image_id', 'DESC')->get();
        $data['videos'] = Video::orderBy('video_id', 'DESC')->get();

        $data['pagination'] = Galeri::orderBy('galery_id', 'desc')
            ->limit(10)->get();
        $data['galeryTerkini'] = $data['pagination'];
        
        return view('infografis.index', $data);
    }
}
