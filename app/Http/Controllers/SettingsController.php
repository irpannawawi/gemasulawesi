<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //
    public function frontend(Request $request)
    {
        return view('settings.frontend');
    }
}