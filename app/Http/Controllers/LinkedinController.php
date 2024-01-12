<?php

namespace App\Http\Controllers;

use App\Jobs\Linkedinjob;
use App\Models\LinkedinAuth;
use App\Models\Posts;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LinkedinController extends Controller
{

    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->scopes(['profile','openid', 'r_liteprofile', 'r_emailaddress', 'w_member_social'])->redirect();
    }

    public function handleLinkedinCallback()
    {
        $user = Socialite::driver('linkedin')->user();
        $linkedinAuth = LinkedinAuth::updateOrCreate([
            'id' => $user->id,
        ],[
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'user' => json_encode($user->user),
            'attributes' => json_encode($user->attributes),
            'token' => $user->token,
        ]);
        return redirect()->route('setting.socials')->with('last_page', 'linkedin')->with('success', 'Berhasil menambahkan akun Linkedin');
    }

    public function unlink()
    {
        $linkedinAuth = LinkedinAuth::first();
        $linkedinAuth->delete();
        return redirect()->route('setting.socials')->with('last_page', 'linkedin')->with('success', 'Berhasil menghapus akun Linkedin');
    }

    public function share()
    {

        Linkedinjob::dispatch(22985)->delay(now()->addMinutes(1));
    }

    public function do_share($title, $description, $image, $tag_list, $url)
    {
        $user = LinkedinAuth::first();

        $http = Http::withToken($user->token)->get('https://api.linkedin.com/v2/userinfo');
        $prson = $http->object();
               // create post
        $postUrl = 'https://api.linkedin.com/v2/ugcPosts';
        $body = [
            "author" => "urn:li:person:{$prson->sub}",
            "lifecycleState" => "PUBLISHED",
            "specificContent" => [
                "com.linkedin.ugc.ShareContent" => [
                    "shareCommentary" => [
                        "text" => $description .' '. $tag_list .' \n '. $url
                    ],
                    "shareMediaCategory" => "ARTICLE",
                    "media" => [
                        [
                            "status" => "READY",
                            "description" => [
                                "text" => $description
                            ],
                            "originalUrl" => $url,
                            "thumbnails"=> [
                                ["url"=> $image],
                            ],
                            "title" => [
                                "text" => $title
                            ]
                        ]
                    ]
                ]
            ],
            "visibility" => [
                "com.linkedin.ugc.MemberNetworkVisibility" => "PUBLIC"
            ]
        ];
        $body = json_encode($body, JSON_UNESCAPED_SLASHES);
        $postHttp = Http::withHeader('X-Restli-Protocol-Version', '2.0.0')
            ->withBody($body)
            ->withToken($user->token)
            ->post($postUrl);
        return $postHttp->object();
    }
}
