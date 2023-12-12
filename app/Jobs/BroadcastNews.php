<?php

namespace App\Jobs;

use App\Models\PushNotification;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\WebPushConfig;

class BroadcastNews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $id;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->onQueue('schedule_broadcast');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        $news = PushNotification::find($this->id);
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
                    ->withData($dataCfg);
        $FcmToken = Subscriber::whereNotNull('token')->pluck('token')->all();
        $res = $messaging->sendMulticast($message, $FcmToken);
        $news->status='sent';
        $res = $news->save();
    }
}
