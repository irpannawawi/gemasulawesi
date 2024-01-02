<?php

namespace App\Http\Controllers;

use Amirsarhang\Instagram;
use App\Models\FbAuth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class IgAuthController extends Controller
{
    // instagram section

    public function instagram_auth()
    {
        // Go to FB Documentations to see available permissions
        $permissions = [
            'instagram_basic',
            'pages_show_list',
            'instagram_manage_comments',
            'instagram_manage_messages',
            'pages_manage_engagement',
            'pages_read_engagement',
            'pages_manage_metadata'
        ];

        // Generate Instagram Graph Login URL
        return Socialite::driver('instagrambasic')->redirect();
    }

    public function handleInstagramCallback()
    {
        // Generate User Access Token After User Callback To Your Site
        //access token 

        $user = Socialite::driver('instagrambasic')->user();
        dd($user);
    }

    public function instagramAccount(): array
    {
        $FbAuth = FbAuth::first();
        $token = $FbAuth->token; // We got it in callback
        dd($token);
        $instagram = new Instagram($token);

        // Will return all instagram accounts that connected to your facebook selected pages.
        return $instagram->getConnectedAccountsList();
    }
}
