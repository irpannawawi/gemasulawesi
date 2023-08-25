<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $data['list_video'] = Video::orderBy('video_id', 'DESC')->get();
        return view('assets.video.view', $data);
    }

    public function add(Request $request)
    {

        return view('assets.video.add');
    }

    public function insert(Request $request)
    {
        $user_id = $request->uploader_id;
        $url = $request->input_url;
        $parsedUrl = parse_url($url);
        parse_str($parsedUrl['query'], $query_ouput);

        $videoId = $query_ouput['v'];
        
        $apikey = 'AIzaSyBsmJTs3VEQZB52KszlQRtdQzTtm01nZcE';
        $googleApiUrl = 'https://www.googleapis.com/youtube/v3/videos?id=' . $videoId . '&key=' . $apikey . '&part=snippet';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($response);

        $value = json_decode(json_encode($data), true);
        $title = $value['items'][0]['snippet']['title'];
        $description = $value['items'][0]['snippet']['description'];

        $dataVideo = [
            'uploader_id'=>$user_id,
            'url'=>$url,
            'title'=>$title,
            'description'=>$description
        ];
        $res = Video::create($dataVideo);
        if($res){
            return redirect()->route('assets.video.index');
        }


    }
}
