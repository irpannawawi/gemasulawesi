<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    //

    public function subscribe(Request $request)
    {
        try{
            Subscriber::create(['token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }

    public function send(Request $request){
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = Subscriber::whereNotNull('token')->pluck('token')->all();
          
        $serverKey = 'AAAAeyFuJF0:APA91bETiDiOkQojH4yqYMF68XxJsmQyLW3lZTROeKx2s38M119llaDmNYE43Zcm3ragLN6ZXW363WUgBQ5BmaQ_pStK5kBB4YkFK-OXWPgRc1OL7sfCqTzVZe9-0VGg9W-ib_-xQ595';
  
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => 'test judul',
                "body" => 'test body',  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result); 
    }
}
