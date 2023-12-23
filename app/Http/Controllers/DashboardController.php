<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'countDraft' => Posts::where('status', 'draft')->count(),
            'countPublished' => Posts::where('status', 'published')->count(),
            'countScheduled' => Posts::where('status', 'scheduled')->count(),
            'countTrash' => Posts::where('status', 'trash')->count(),
        ];
        return view('dashboard', $data);
    }

    public function chartData()
    {
        
        $startDate = Carbon::now()->subMonths(12);
    $endDate = Carbon::now();
        $data = DB::table('posts')
            ->select(DB::raw('MONTHNAME(published_at) as month'), DB::raw('COUNT(*) as total'))
            ->whereBetween('published_at', [$startDate, $endDate])
            ->groupBy('month')
            ->get();

        return response()->json($data);
    }
}
