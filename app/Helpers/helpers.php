<?php

use App\Models\Posts;
use Illuminate\Support\Facades\Storage;

if(!function_exists('getYoutubeData'))
{
    function getYoutubeData($url)
    {
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
        return $value = json_decode(json_encode($data))->items[0];
    }

    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    function convert_date_to_ID($date)
    {
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        $converted = \Carbon\Carbon::parse($date, 'id_ID');
        return $converted->isoFormat('D MMMM Y H:mm [WIB]');
    }

    function get_post_image($post_id){
        $post = Posts::find($post_id);
        $url = Storage::url('public/photos/'.$post->image->asset->file_name);
        return $url;
    }
}