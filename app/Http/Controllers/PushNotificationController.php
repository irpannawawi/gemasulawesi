<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\PushNotification;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    //

    public function subscribe(Request $request)
    {
        try{
            if(!Subscriber::where("token", $request->token)->exists()){
            Subscriber::create(['token'=>$request->token]);
            }
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

    public function send(Request $request, $id){

        $news = PushNotification::find($id);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = Subscriber::whereNotNull('token')->pluck('token')->all();
        $serverKey = 'AAAAeyFuJF0:APA91bETiDiOkQojH4yqYMF68XxJsmQyLW3lZTROeKx2s38M119llaDmNYE43Zcm3ragLN6ZXW363WUgBQ5BmaQ_pStK5kBB4YkFK-OXWPgRc1OL7sfCqTzVZe9-0VGg9W-ib_-xQ595';
  
        $data = [
            "registration_ids" => $FcmToken,
            // "notification" => [
            //     "click_action" => str_replace('http://', 'https://', $news->url),  
            // ],
            "data"=>[
                "title" => $news->title,
                "body" => $news->body,  
                "click_action" => str_replace('http://', 'https://', $news->url),  
                "message_id" => date('YmdHis'),
            ]
        ];
        // dd($data);
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
        // dd($result);
        $news->status='sent';
        $news->save();
        return redirect()->back(); 
    }


    public function index()
    {
        $data['pushNotification'] = PushNotification::orderBy('notif_id', 'desc')->get();
        return view('push-notification.index', $data);
    }

    public function add()
    {
        $data['posts'] = Posts::orderBy('published_at', 'desc')->where('status', 'published')->paginate('20');
        return view('push-notification.add', $data);
    }

    public function store(Request $request)
    {
        $post = Posts::find($request->post_id);
        $data = [
            'post_id'=>$request->post_id,
            'title'=>$request->title,
            'body'=>$request->description,
            'url'=>route('singlePost', [
                'rubrik' => $post->rubrik->rubrik_name,
                'post_id' => $post->post_id,
                'slug' => $post->slug,
            ]),
            'status'=>'queue',
        ];

        if(PushNotification::create($data))
        {
            return redirect('pushNotification')->with('message', 'Berhasil tambah');
        }

    }
    
    

    
    
    public function delete($id)
    {
        if(PushNotification::where('notif_id', $id)->delete())
        {
            return redirect('pushNotification')->with('message', 'Berhasil menghapus news');
        }
        
    }
}
