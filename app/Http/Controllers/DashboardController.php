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

    public function failed_jobs()
    {
        $failed_jobs = DB::table('failed_jobs')->limit(20)->orderBy('failed_at', 'desc')->get();
        return view('failed_jobs', ['failed_jobs' => $failed_jobs]);
    }

    public function chartData()
    {
        
        $startDate = Carbon::now()->subMonths(12);
    $endDate = Carbon::now();
        $data = DB::table('posts')
        ->select(DB::raw('DATE_FORMAT(published_at, "%Y-%m") as month'), DB::raw('COUNT(*) as total'))
        ->whereBetween('published_at', [$startDate, $endDate])
        ->groupBy(DB::raw('DATE_FORMAT(published_at, "%Y-%m")'))
        ->orderBy(DB::raw('DATE_FORMAT(published_at, "%Y-%m")'))
        ->get();
        return response()->json($data);
    }
}
