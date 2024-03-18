<?php

namespace App\Http\Controllers;

use App\Jobs\BroadcastNews;
use App\Models\Posts;
use App\Models\PushNotification;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

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
        $FcmToken = Subscriber::whereNotNull('token')->pluck('token')->all();

        $messaging = app('firebase.messaging');

        $config = WebPushConfig::fromArray([
            "data"=>[
                "title" => $news->title,
                "body" => $news->body,  
                "click_action" => str_replace('http://', 'https://', $news->url),  
                "message_id" => date('YmdHis'),
            ]
        ]);

        $dataCfg = [
            "title" => $news->title,
            "body" => $news->body,  
            "click_action" => str_replace('http://', 'https://', $news->url),  
            "message_id" => date('YmdHis'),
        ];

        $message = CloudMessage::new();
        $message = $message->withWebPushConfig($config)
                    ->withData($dataCfg)->withNotification(Notification::create('News', $news->title));
        $FcmToken = Subscriber::whereNotNull('token')->pluck('token')->all();
        $res = $messaging->sendMulticast($message, $FcmToken);
        $news->status='sent';
        dd($res);
        $news->save();
        return redirect()->back(); 

    }


    public function index()
    {
        $data['pushNotification'] = PushNotification::orderBy('notif_id', 'desc')->paginate(20);
        return view('push-notification.index', $data);
    }    
    
    public function browse(Request $request) {
        $q = $request->q;
        $rubrik = $request->rubrik;
        if($rubrik==null)
        {
            $rubrik='';
        }
        $data['rubrikId'] = $rubrik;
        $data['q'] = $q;

        $posts = $this->getPost($request, 'published');
        $data['posts'] =$posts->paginate(20);
        
        return view('push-notification.browse_article', $data);
    }

    public function add()
    {
        return view('push-notification.add');
    }

    public function store(Request $request)
    {
        $post = Posts::find($request->post_id);
        $data = [
            'post_id'=>$request->post_id,
            'title'=>$request->title,
            'body'=>$request->description,
            'url'=>route('singlePost', [
                'rubrik' => Str::slug($post->rubrik->rubrik_name),
                'post_id' => $post->post_id,
                'slug' => $post->slug,
            ]),
            'status'=>'queue',
            'scheduled_at'=>Str::replace('T', ' ', $request->schedule)
        ];
        $message = PushNotification::create($data);
        if($message)
        {
            // add to schedule
            $time = Str::replace('T', ' ', $request->schedule);
            $carbonTime = Carbon::createFromFormat('Y-m-d H:i', $time);
            BroadcastNews::dispatch($message->notif_id)->onQueue('schedule_broadcast')->delay($carbonTime);
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

    public function test(Request $request){

        
        $FcmToken = 'ePaWIv3c7aquAsdhPlPvpS:APA91bFk5OgyOSeGwD4g3NWvIKDRV6FBYDc3gNfAVmaWBB0ALSt7-5B7diSFZ5_4JInly4s4ILJqdrZG4sMd45J27Uq6xg1FxQ0a11-dqJM0jdEETR_OEChP6r5fP0A1zb9CzgWVbidc';

        $messaging = app('firebase.messaging');

        $config = WebPushConfig::fromArray([
            "data"=>[
                "title" =>'Title',
                "body" => 'Body',  
                "click_action" => str_replace('http://', 'https://', 'https://google.com'),  
                "message_id" => date('YmdHis'),
            ]
        ]);

        $dataCfg = [
            "title" => '$news->title',
            "body" => '$news->body',  
            "click_action" => str_replace('http://', 'https://', '$news->url'),  
            "message_id" => date('YmdHis'),
        ];

        $message = CloudMessage::new();
        $message = $message->withWebPushConfig($config)
                    ->withData($dataCfg);
        $FcmToken = Subscriber::whereNotNull('token')->pluck('token')->all();
        $res = $messaging->sendMulticast($message, $FcmToken);
        dd($res);

    }

    
    private function getPost($request, $status)
    {
        $q = $request->q;
        $data['q'] = $q;

        // chek if sorted
        $posts = Posts::where('status', $status);

        if (!empty($request->sort_by)) {
            $posts = $posts->orderBy( $request->sort_by, $request->order);
        }else{
            $posts = $posts->orderBy('published_at', 'DESC');
        }
        // chek if has query string
        if (!empty($q)) {
            $posts = $posts->where('title', 'LIKE', '%' . $q . '%');
        }
        // chek if filtered category
        if (!empty($request->rubrik)) {
            $posts = $posts->where('category', '=', $request->rubrik);
        }
        // chek if filtered author
        
        if (!empty($request->author)) {
            $posts = $posts->where('author_id', '=', $request->author);
        }
        // chek if filtered date
        if (!empty($request->dates)) {
            $dates = explode(' - ', $request->dates);
            
            $start_date = Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d 00:00:00');
            $end_date = Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d 23:59:59');
            $posts = $posts->whereBetween('published_at', [$start_date, $end_date]);
        }

        return $posts;
    }

}
