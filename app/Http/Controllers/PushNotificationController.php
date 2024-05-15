<?php

namespace App\Http\Controllers;

use App\Jobs\BroadcastNews;
use App\Jobs\ProccessNotification;
use App\Models\Posts;
use App\Models\PushNotification;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
// use Kreait\Firebase\Messaging\WebPushConfig;
// use Kreait\Firebase\Messaging\CloudMessage;
// use Kreait\Firebase\Messaging\Notification;

use DateTime;
use onesignal\client\api\DefaultApi;
use onesignal\client\Configuration;
use onesignal\client\model\GetNotificationRequestBody;
use onesignal\client\model\Notification;
use onesignal\client\model\StringMap;
use onesignal\client\model\Player;
use onesignal\client\model\UpdatePlayerTagsRequestBody;
use onesignal\client\model\ExportPlayersRequestBody;
use onesignal\client\model\Segment;
use onesignal\client\model\FilterExpressions;
use PHPUnit\Framework\TestCase;
use GuzzleHttp;
use Illuminate\Support\Facades\Storage;

const APP_ID = '56d38667-b3e2-4a80-af97-1ce96a331c23';
const APP_KEY_TOKEN = 'MzIzYjkzMGEtM2ZmMy00M2QzLTgxMzctZGNkMzFiNTRjOGJh';
const USER_KEY_TOKEN = 'MmVjYTc2MDktZjNiNi00MWQyLTkxYmUtZTZjZDRmODFhY2E5';

class PushNotificationController extends Controller
{
    //

    public function subscribe(Request $request)
    {
        try {
            if (!Subscriber::where("token", $request->token)->exists()) {
                Subscriber::create(['token' => $request->token]);
            }
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }

    public function send(Request $request, $id)
    {
        $notification_data = PushNotification::find($id);
        $notification = $this->createNotification(
            Posts::find($notification_data->post_id),
            Carbon::now()->format('Y-m-d H:i')
        );
        $result = $this->apiInstance()->createNotification($notification);
        if ($result) {
            return redirect('pushNotification')->with('message', 'Berhasil tambah');
        }
    }


    public function index()
    {
        $players = $this->apiInstance()->getApp(APP_ID);
        $data['players'] = json_decode($players);


        $data['pushNotification'] = PushNotification::orderBy('notif_id', 'desc')->paginate(20);
        return view('push-notification.index', $data);
    }

    public function browse(Request $request)
    {
        $q = $request->q;
        $rubrik = $request->rubrik;
        if ($rubrik == null) {
            $rubrik = '';
        }
        $data['rubrikId'] = $rubrik;
        $data['q'] = $q;

        $posts = $this->getPost($request, 'published');
        $data['posts'] = $posts->paginate(20);

        return view('push-notification.browse_article', $data);
    }

    public function add()
    {
        return view('push-notification.add');
    }

    public function store(Request $request)
    {
        $post = Posts::find($request->post_id);
        $notification = $this->createNotification($post, $request->schedule);
        $data = [
            'post_id' => $request->post_id,
            'title' => $request->title,
            'body' => $request->description,
            'url' => route('singlePost', [
                'rubrik' => Str::slug($post->rubrik->rubrik_name),
                'post_id' => $post->post_id,
                'slug' => $post->slug,
            ]),
            'status' => 'queue',
            'scheduled_at' => Str::replace('T', ' ', $request->schedule)
        ];

        $message = PushNotification::create($data);
        $result = $this->apiInstance()->createNotification($notification);
        if ($message && $result) {
            return redirect('pushNotification')->with('message', 'Berhasil tambah');
        }


        // $message = PushNotification::create($data);
        // if ($message) {
        //     // add to schedule
        //     $time = Str::replace('T', ' ', $request->schedule);
        //     $carbonTime = Carbon::createFromFormat('Y-m-d H:i', $time);
        //     BroadcastNews::dispatch($message->notif_id)->onQueue('schedule_broadcast')->delay($carbonTime);
        // }
    }





    public function delete($id)
    {
        if (PushNotification::where('notif_id', $id)->delete()) {
            return redirect('pushNotification')->with('message', 'Berhasil menghapus news');
        }
    }

    public function test(Request $request)
    {


        // $FcmToken = 'ePaWIv3c7aquAsdhPlPvpS:APA91bFk5OgyOSeGwD4g3NWvIKDRV6FBYDc3gNfAVmaWBB0ALSt7-5B7diSFZ5_4JInly4s4ILJqdrZG4sMd45J27Uq6xg1FxQ0a11-dqJM0jdEETR_OEChP6r5fP0A1zb9CzgWVbidc';
        $FcmToken = Subscriber::whereNotNull('token')->pluck('token')->all();
        dd($FcmToken);
        $messaging = app('firebase.messaging');

        $config = WebPushConfig::fromArray([
            "data" => [
                "title" => 'Title',
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
        $res = $messaging->sendMulticast($message, $FcmToken);
    }


    private function getPost($request, $status)
    {
        $q = $request->q;
        $data['q'] = $q;

        // chek if sorted
        $posts = Posts::where('status', $status);

        if (!empty($request->sort_by)) {
            $posts = $posts->orderBy($request->sort_by, $request->order);
        } else {
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


    private function createNotification($post, $schedule)
    {
        $heading = new StringMap();
        $content = new StringMap();
        $imageUrl = env('APP_URL').get_post_image($post->post_id);
        $heading->setEn($post->title);
        $heading->setId($post->title);
        $content->setEn($post->description);
        $content->setId($post->description);
        $postUrl = route('singlePost', [
            'rubrik' => Str::slug($post->rubrik->rubrik_name),
            'post_id' => $post->post_id,
            'slug' => $post->slug,
        ]);

        $notification = new Notification();
        $notification->setAppId(APP_ID);
        $notification->setContents($content);
        $notification->setHeadings($heading);
        $notification->setBigPicture($imageUrl);
        $notification->setChromeBigPicture($imageUrl);
        $notification->setChromeWebImage($imageUrl);
        $notification->setSmallIcon(Storage::url('favicon/') . get_setting('favicon'));
        $time = Str::replace('T', ' ', $schedule);
        $carbonTime = Carbon::createFromFormat('Y-m-d H:i', $time);
        $notification->setSendAfter($carbonTime);

        $notification->setUrl($postUrl);
        $segment = env('APP_ENV') == 'local' ? 'Test Segment' : 'Active Subscriptions';
        $notification->setIncludedSegments([$segment]);

        return $notification;
    }

    private function apiInstance()
    {
        $config = Configuration::getDefaultConfiguration()
            ->setAppKeyToken(APP_KEY_TOKEN)
            ->setUserKeyToken(USER_KEY_TOKEN);

        $apiInstance = new DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );

        return $apiInstance;
    }
}
