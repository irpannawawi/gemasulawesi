<?php

namespace App\Http\Controllers;

use App\Models\XAuth;
use Illuminate\Support\Facades\Http;
use Noweh\TwitterApi\Client;
use Laravel\Socialite\Facades\Socialite;

class XController extends Controller
{
    /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function x_auth()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Handle the callback from Twitter authentication.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function x_callback()
    {
        $user = Socialite::driver('twitter')->user();

        $x = XAuth::updateOrCreate(
            ['id' => $user->id],
            [
                'nickname' => $user->nickname,
                'name' => $user->name,
                'user' => json_encode($user->user),
                'attributes' => json_encode($user->attributes),
                'token' => $user->token,
                'token_secret' => $user->tokenSecret,
            ]
        );
        
        return redirect('setting/socials')->with('success', 'X Account Connected Successfully');
    }

    public function x_logout()
    {
        XAuth::truncate();
        return redirect('setting/socials')->with('success', 'X Account Disconnected Successfully');

    }
    /**
     * Share a tweet using the XAuth credentials.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shareX()
    {
        $xCred = XAuth::first();
        
        $twitterSettings = [
            'account_id' => $xCred->id,
            'access_token' => $xCred->token,
            'access_token_secret' => $xCred->token_secret,
            'consumer_key' => env('X_CLIENT_ID'),
            'consumer_secret' => env('X_CLIENT_SECRET'),
            'bearer_token' => env('X_BEARER_TOKEN')
        ];
        
        $client = new Client($twitterSettings);
        $tweet = $client->tweet()->create();
        $tweet->performRequest([
            'text' =>"Test message"
        ]);
        dd($tweet);
        return redirect()->back();
    }


}