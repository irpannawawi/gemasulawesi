<?php

namespace App\Http\Controllers;

use App\Jobs\Linkedinjob;
use App\Models\LinkedinAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        Linkedinjob::dispatch(22668);
    }
}
