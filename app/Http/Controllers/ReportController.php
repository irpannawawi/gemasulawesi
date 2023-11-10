<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    //

    public function editor(Request $request)
    {
        if ($request->daterange != null) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0].' 00:00:00';
            $end_date = $daterange[1].' 23:59:59';
        } else {
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        DB::enableQueryLog();

        $data = [
            "users" => User::with(['posts'=>function ($query) use ($start_date, $end_date) {
                return $query->where('status', '=', 'published')
                ->whereBetween('created_at', [$start_date, $end_date]);
            }])->get(),
        ];

        $query = DB::getQueryLog();
        // dd($query);
        $data['daterange'] = $request->daterange;
        return view("report.view", $data);
    }

    public function author(Request $request)
    {
        if ($request->daterange != null) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0].' 00:00:00';
            $end_date = $daterange[1].' 23:59:59';
        } else {
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        DB::enableQueryLog();

        $data = [
            "users" => User::with(['postsAuthor'=>function ($query) use ($start_date, $end_date) {
                return $query->where('status', '=', 'published')
                ->whereBetween('created_at', [$start_date, $end_date]);
            }])->get(),
        ];

        $query = DB::getQueryLog();
        $data['daterange'] = $request->daterange;
        return view("report.author", $data);
    }

    public function articles(Request $request)
    {
        if ($request->daterange != null) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        } else {
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }

        $data = [
            "posts" => Posts::whereHas('rubrik')->where([
                ['status', '=', 'published']
            ])->whereBetween('created_at', [$start_date, $end_date])->orderBy('created_at', 'desc')->get(),
        ];
        $data['daterange'] = $request->daterange;
        return view("report.articles", $data);
    }

    public function section(Request $request)
    {
        if ($request->daterange != null) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        } else {
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }

        $data = [
            "sections" => Rubrik::whereHas('posts', function ($query) use ($start_date, $end_date) {
                return $query->where([
                    ['status', '=', 'published'],
                ])->whereBetween('created_at', [$start_date, $end_date]);
            })->orderBy('created_at', 'desc')->get(),
        ];
        $data['daterange'] = $request->daterange;
        return view("report.section", $data);
    }

    public function articles_user(Request $request)
    {
        
        DB::enableQueryLog();

        $data = [
            "posts" => Posts::where('author_id', $request->id)->orWhere('editor_id', $request->id)->paginate(10)->withQueryString(),
        ];

        $query = DB::getQueryLog();
        $data['id'] = $request->id;
        return view("report.user_articles", $data);
    }

    // exporter
    public function editor_export(Request $request)
    {
        if ($request->daterange != null) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        } else {
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        $users = User::whereHas('postsAuthor', function ($query) use ($start_date, $end_date) {
            return $query->where([
                ['status', '=', 'published']
            ])->whereBetween('created_at', [$start_date, $end_date]);
        })->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'NO');
        $activeWorksheet->setCellValue('B1', 'EDITOR');
        $activeWorksheet->setCellValue('C1', 'ARTICLES');
        $n=0;
        $i=1;
        foreach ($users as $user) {
            $n++;
            $i++;
            $activeWorksheet->setCellValue('A'.$i, $n);
            $activeWorksheet->setCellValue('B'.$i, $user->display_name);
            $activeWorksheet->setCellValue('C'.$i, $user->posts->count());
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save(storage_path('app/public/laporan_author.xlsx'));
        
        
        ob_end_clean();
        return response()->download('storage/laporan_author.xlsx', 'laporan.xlsx', [
            'Content-Type'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition'=>'attachment; filename="your_file.xls"',
        ])->deleteFileAfterSend();
    }

    public function author_export(Request $request)
    {
        if ($request->daterange != null) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        } else {
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        $users = User::whereHas('postsAuthor', function ($query) use ($start_date, $end_date) {
            return $query->where([
                ['status', '=', 'published']
            ])->whereBetween('created_at', [$start_date, $end_date]);
        })->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'NO');
        $activeWorksheet->setCellValue('B1', 'AUTHOR');
        $activeWorksheet->setCellValue('C1', 'ARTICLES');
        $n=0;
        $i=1;
        foreach ($users as $user) {
            $n++;
            $i++;
            $activeWorksheet->setCellValue('A'.$i, $n);
            $activeWorksheet->setCellValue('B'.$i, $user->display_name);
            $activeWorksheet->setCellValue('C'.$i, $user->posts->count());
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save(storage_path('app/public/laporan_author.xlsx'));
        
        
        ob_end_clean();
        return response()->download('storage/laporan_author.xlsx', 'laporan.xlsx', [
            'Content-Type'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition'=>'attachment; filename="your_file.xls"',
        ])->deleteFileAfterSend();
    }

    
    public function articles_export(Request $request)
    {
        if ($request->daterange != null) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        } else {
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        $articles = Posts::whereHas('rubrik')->where([
            ['status', '=', 'published']
        ])->whereBetween('created_at', [$start_date, $end_date])->orderBy('created_at', 'desc')->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'NO');
        $activeWorksheet->setCellValue('B1', 'TITLE');
        $activeWorksheet->setCellValue('C1', 'SECTION');
        $activeWorksheet->setCellValue('D1', 'AUTHOR');
        $activeWorksheet->setCellValue('E1', 'EDITOR');
        $n=0;
        $i=1;
        foreach ($articles as $post) {
            $n++;
            $i++;
            $activeWorksheet->setCellValue('A'.$i, $n);
            $activeWorksheet->setCellValue('B'.$i, $post->title);
            $activeWorksheet->setCellValue('C'.$i, $post->rubrik->rubrik_name);
            $activeWorksheet->setCellValue('D'.$i, $post->author->display_name);
            $activeWorksheet->setCellValue('E'.$i, $post->editor->display_name);
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save(storage_path('app/public/laporan_author.xlsx'));
        
        
        ob_end_clean();
        return response()->download('storage/laporan_author.xlsx', 'laporan.xlsx', [
            'Content-Type'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition'=>'attachment; filename="your_file.xls"',
        ])->deleteFileAfterSend();
    }    
    public function section_export(Request $request)
    {
        if ($request->daterange != null) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        } else {
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        $sections = Rubrik::whereHas('posts', function ($query) use ($start_date, $end_date) {
            return $query->where([
                ['status', '=', 'published'],
            ])->whereBetween('created_at', [$start_date, $end_date]);
        })->orderBy('created_at', 'desc')->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'NO');
        $activeWorksheet->setCellValue('B1', 'SECTION');
        $activeWorksheet->setCellValue('C1', 'ARTICLES');
        $n=0;
        $i=1;
        foreach ($sections as $section) {
            $n++;
            $i++;
            $activeWorksheet->setCellValue('A'.$i, $n);
            $activeWorksheet->setCellValue('B'.$i, $section->rubrik_name);
            $activeWorksheet->setCellValue('C'.$i, $section->posts->count());
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save(storage_path('app/public/laporan_author.xlsx'));
        
        
        ob_end_clean();
        return response()->download('storage/laporan_author.xlsx', 'laporan.xlsx', [
            'Content-Type'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition'=>'attachment; filename="your_file.xls"',
        ])->deleteFileAfterSend();
    }

    
    public function articles_user_export(Request $request)
    {
        if ($request->daterange != null) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0];
            $end_date = $daterange[1];
        } else {
            $start_date = date('Y-m');
            $end_date = date('Y-m');
        }
        $articles = Posts::where('author_id', $request->id)->orWhere('editor_id', $request->id)->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'NO');
        $activeWorksheet->setCellValue('B1', 'TITLE');
        $activeWorksheet->setCellValue('C1', 'SECTION');
        $activeWorksheet->setCellValue('D1', 'AUTHOR');
        $activeWorksheet->setCellValue('E1', 'EDITOR');
        $n=0;
        $i=1;
        foreach ($articles as $post) {
            $n++;
            $i++;
            $activeWorksheet->setCellValue('A'.$i, $n);
            $activeWorksheet->setCellValue('B'.$i, $post->title);
            $activeWorksheet->setCellValue('C'.$i, $post->rubrik->rubrik_name);
            $activeWorksheet->setCellValue('D'.$i, $post->author->display_name);
            $activeWorksheet->setCellValue('E'.$i, $post->editor->display_name);
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save(storage_path('app/public/laporan_author.xlsx'));
        
        
        ob_end_clean();
        return response()->download('storage/laporan_author.xlsx', 'laporan.xlsx', [
            'Content-Type'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition'=>'attachment; filename="your_file.xls"',
        ])->deleteFileAfterSend();
    } 
}
