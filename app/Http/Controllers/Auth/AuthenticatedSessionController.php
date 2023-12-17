<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->gtoken,
            ];
            $resp = Http::asForm()->post($url, $data);
            $resp = $resp->object();

            if($resp->success){
                $request->session()->regenerate();
                $response = ['success'=>true];
            }else{
                $response = ['success'=>false, 'message'=>'invalid captcha'];
            }
        }else{
            $response = ['success'=>false, 'message'=>'user credential didn\'t match!'];
        }
        
        
        return response()->json($response);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
