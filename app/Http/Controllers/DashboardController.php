<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'countDraft'=>Posts::where('status', 'draft')->count(),
            'countPublished'=>Posts::where('status', 'published')->count(),
            'countScheduled'=>Posts::where('status', 'scheduled')->count(),
            'countTrash'=>Posts::where('status', 'trash')->count(),
        ];
        return view('dashboard', $data);
    }
}
