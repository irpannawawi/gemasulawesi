<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $startDate = Carbon::now()->subMonths(12);
        $endDate = Carbon::now();


        $today = Carbon::today()->format('Y-m-d').' 59:59:59';
        $yesterday = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        // popular os
        $analytics = Cache::remember('visitor-analytics', 60*2, function () use ($startDate, $endDate) {
            return Http::get(env('VISITOR_API') . '/api/visitors/analytics' . '?start_date=' . $startDate->format('Y-m-d H:i') . '&end_date=' . $endDate->format('Y-m-d H:i'))->json();
        });
        // hot topics
        $hotPost = cache()->remember('hotTopics', 120, function () use ($today, $yesterday) {
            return Posts::orderBy('visit', 'desc')
                ->where(['status' => 'published'])
                ->where('published_at', '>=', Carbon::yesterday()->format('Y-m-d 00:00:00'))
                ->where('published_at', '<=', $today)
                ->limit(10)
                ->get();
        });
        
        $data = [
            'countDraft' => Posts::where('status', 'draft')->count(),
            'countPublished' => Posts::where('status', 'published')->count(),
            'countScheduled' => Posts::where('status', 'scheduled')->count(),
            'countTrash' => Posts::where('status', 'trash')->count(),
            'hotPost' => $hotPost,
            'analytics' => $analytics,
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

        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d 00:00:00');
        $endDate = Carbon::now();
        $data = Posts::whereBetween('published_at', [$startDate, $endDate])
            ->where('status', 'published')
            ->get()
            ->groupBy('author_id')
            ->map(function ($item) {
                return ['author_name' => User::find($item->first()->author_id)->display_name, 'total' => count($item)];
            })->values();
        return response()->json($data);
    }

    public function chartDataVisitor()
    {

        $startDate = Carbon::now()->subMonths(12);
        $endDate = Carbon::now();
        $data = Cache::remember('chartDataVisitor', 60*2, function () use ($startDate, $endDate) {
                return Http::get(env('VISITOR_API') . '/api/visitors' . '?start_date=' . $startDate->format('Y-m-d') . '&end_date=' . $endDate->format('Y-m-d'))->json();
            });

        $visitors = collect($data)->sortBy('created_at');
        $result = $visitors->groupBy(function ($item) {
            return Carbon::parse($item['created_at'])->format('Y-m');
        })->map(function ($item) {
            return ['month' => Carbon::parse($item[0]['created_at'])->format('M'), 'total' => count($item)];
        })->values();

        return response()->json($result);
    }
}
