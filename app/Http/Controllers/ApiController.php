<?php

namespace App\Http\Controllers;

use App\Jobs\MigrateJob;
use App\Models\Asset;
use App\Models\Image;
use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Tags;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function share(Request $request)
    {
        $key = env('DLVR_KEY');
        $url = 'https://api.dlvrit.com/1/accounts.json';
        $res = Http::withQueryParameters(['key'=>$key])->get($url)->object();
        foreach($res->accounts as $account)
        {
            $id = $account->id;
            // post to account
            $params = [
                'key'=>$key,
                'id'=>$id,
                'msg'=>'Ini adalah contoh share https://www.gemasulawesi.com/id/kesehatan/21910/dijuluki-sebagai-the-miracle-tree-berbagai-manfaat-secara-kesehatan-ini-bisa-diperoleh-dari-mengonsumsi-daun-kelor',
                // 'shared'=>1,
                'queue'=>1,
                // 'media'=>Storage::get('public/photos/1aditya-penderita-tumor-langka-stadium-empat.jpeg'),
                'title'=>'Auto Share test'
            ];
            dd($params);
            $res = Http::withQueryParameters($params)->get('https://api.dlvrit.com/1/postToAccoun.json');
        }
        dd($res->object());
    }
}
