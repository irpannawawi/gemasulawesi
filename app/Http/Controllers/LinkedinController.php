<?php

namespace App\Http\Controllers;

use App\Models\LinkedinAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class LinkedinController extends Controller
{

    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->scopes(['profile', 'openid', 'r_liteprofile', 'r_emailaddress', 'w_member_social'])->redirect();
    }

    public function handleLinkedinCallback()
    {
        $user = Socialite::driver('linkedin')->user();
        $linkedinAuth = LinkedinAuth::updateOrCreate([
            'id' => $user->id,
        ], [
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
        $user = LinkedinAuth::first();

        $http = Http::withToken($user->token)->get('https://api.linkedin.com/v2/userinfo');
        $prson = $http->object();

        $postUrl = 'https://api.linkedin.com/v2/ugcPosts';
        $body = [
            "author" => "urn:li:person:{$prson->sub}",
            "lifecycleState" => "PUBLISHED",
            "specificContent" => [
                "com.linkedin.ugc.ShareContent" => [
                    "shareCommentary" => [
                        "text" => "test Coment Linkedin"
                    ],
                    "shareMediaCategory" => "ARTICLE",
                    "media"=> [
                        [
                            "status"=> "READY",
                            "description"=> [
                                "text"=> "Your source for insights and information about LinkedIn."
                            ],
                            "originalUrl"=> "https://blog.linkedin.com/",
                            "title"=> [
                                "text"=> "Official LinkedIn Blog Test"
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
        dd($postHttp->object());
    }
}
