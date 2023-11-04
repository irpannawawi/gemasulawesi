<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //

    public function editor(Request $request){
        if($request->daterange != null){
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        }else{
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        DB::enableQueryLog();
        
        $data = [
            "users"=> User::whereHas('posts', function($query) use($start_date, $end_date) {
                return $query->where([
                    ['status', '=', 'published']
                ])->whereBetween('created_at', [$start_date, $end_date]);
            })->get(),
        ];

        $query = DB::getQueryLog();
        $data['daterange'] = $request->daterange;
        return view("report.view", $data);
    }

    public function author(Request $request){
        if($request->daterange != null){
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        }else{
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        DB::enableQueryLog();
        
        $data = [
            "users"=> User::whereHas('postsAuthor', function($query) use($start_date, $end_date) {
                return $query->where([
                    ['status', '=', 'published']
                ])->whereBetween('created_at', [$start_date, $end_date]);
            })->get(),
        ];

        $query = DB::getQueryLog();
        $data['daterange'] = $request->daterange;
        return view("report.author", $data);
    }

    public function articles(Request $request){
        if($request->daterange != null){
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        }else{
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        
        $data = [
            "posts"=> Posts::whereHas('rubrik')->where([
                    ['status', '=', 'published']
                ])->whereBetween('created_at', [$start_date, $end_date])->orderBy('created_at', 'desc')->get(),
        ];
        $data['daterange'] = $request->daterange;
        return view("report.articles", $data);
    }
}
