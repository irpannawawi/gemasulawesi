<?php 
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

}