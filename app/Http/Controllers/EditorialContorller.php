<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorialContorller extends Controller
{
    public function create()
    {
        return view('editorial.create');
    }
}
