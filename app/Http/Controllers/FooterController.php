<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function about()
    {
        return view('footer.about');
    }
    public function kodeetik()
    {
        return view('footer.kodeetik');
    }
    public function redaction()
    {
        return view('footer.redaksi');
    }
}
