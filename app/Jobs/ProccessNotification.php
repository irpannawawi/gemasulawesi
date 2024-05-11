<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\PushNotification;
use App\Models\Subscriber;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class ProccessNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $id;

    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->onConnection('database');
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
            "data" => [
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

        foreach (array_chunk($FcmToken, 500) as $subs) {
            $res = $messaging->sendMulticast($message, $subs);
        }
        $news->status = 'sent';
        $news->save();
    }
}
