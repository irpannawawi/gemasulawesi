<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(): View
    {
        return view('frontend.web');
    }

    public function singlePost(): View
    {
        return view('frontend.singlepost');
    }
}
