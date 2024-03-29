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

        $data = [
            "users" => User::with(['posts'=>function ($query) use ($start_date, $end_date) {
                $query->where('status', '=', 'published')
                ->whereBetween('published_at', [$start_date, $end_date]);
            }])->whereNot('role',  'inactive')->get(),
        ];

        // dd($query);
        $data['daterange'] = $request->daterange;
        return view("report.view", $data);
    }

    public function author(Request $request)
    {
        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0] . ' 00:00:00';
            $end_date = $daterange[1] . ' 23:59:59';
        } else {
            $start_date = date('Y-m-01 00:00:00');
            $end_date = date('Y-m-t 23:59:59');
        }
        
        DB::enableQueryLog();
        
        $data = [
            "users" => User::with(['postsAuthor' => function ($query) use ($start_date, $end_date) {
                $query->where('status', '=', 'published')
                    ->whereBetween('published_at', [$start_date, $end_date]);
            }])->whereNot('role',  'inactive')->get(),
        ];
        
        $queryLog = DB::getQueryLog();
        // dd($queryLog);
        
        $data['daterange'] = $request->daterange;
        return view("report.author", $data);
        
    }

    public function articles(Request $request)
    {
        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0] . ' 00:00:00';
            $end_date = $daterange[1] . ' 23:59:59';
        } else {
            $start_date = date('Y-m-01 00:00:00');
            $end_date = date('Y-m-t 23:59:59');
        }

        $data = [
            "posts" => Posts::whereHas('rubrik')->where([
                ['status', '=', 'published']
            ])->whereBetween('published_at', [$start_date, $end_date])
            ->orderBy('published_at', 'desc')->paginate(20)->withQueryString(),
        ];
        $data['daterange'] = $request->daterange;
        return view("report.articles", $data);
    }

    public function section(Request $request)
    {
        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0] . ' 00:00:00';
            $end_date = $daterange[1] . ' 23:59:59';
        } else {
            $start_date = date('Y-m-01 00:00:00');
            $end_date = date('Y-m-t 23:59:59');
        }

        $data = [
            "sections" => Rubrik::whereHas('posts', function ($query) use ($start_date, $end_date) {
                return $query->where([
                    ['status', '=', 'published'],
                ])->whereBetween('published_at', [$start_date, $end_date]);
            })->orderBy('rubrik_name', 'desc')->get(),
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
        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0] . ' 00:00:00';
            $end_date = $daterange[1] . ' 23:59:59';
        } else {
            $start_date = date('Y-m-01 00:00:00');
            $end_date = date('Y-m-t 23:59:59');
        }

        $users = User::whereHas('postsAuthor', function ($query) use ($start_date, $end_date) {
            return $query->where([
                ['status', '=', 'published']
            ])->whereBetween('published_at', [$start_date, $end_date]);
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
        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0] . ' 00:00:00';
            $end_date = $daterange[1] . ' 23:59:59';
        } else {
            $start_date = date('Y-m-01 00:00:00');
            $end_date = date('Y-m-t 23:59:59');
        }

        $users = User::whereHas('postsAuthor', function ($query) use ($start_date, $end_date) {
            return $query->where([
                ['status', '=', 'published']
            ])->whereBetween('published_at', [$start_date, $end_date]);
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
        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0] . ' 00:00:00';
            $end_date = $daterange[1] . ' 23:59:59';
        } else {
            $start_date = date('Y-m-01 00:00:00');
            $end_date = date('Y-m-t 23:59:59');
        }
        $articles = Posts::whereHas('rubrik')->where([
            ['status', '=', 'published']
        ])->whereBetween('published_at', [$start_date, $end_date])->orderBy('published_at', 'desc')->get();
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
        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0] . ' 00:00:00';
            $end_date = $daterange[1] . ' 23:59:59';
        } else {
            $start_date = date('Y-m-01 00:00:00');
            $end_date = date('Y-m-t 23:59:59');
        }
        $sections = Rubrik::whereHas('posts', function ($query) use ($start_date, $end_date) {
            return $query->where([
                ['status', '=', 'published'],
            ])->whereBetween('published_at', [$start_date, $end_date]);
        })->orderBy('published_at', 'desc')->get();
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
        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = $daterange[0] . ' 00:00:00';
            $end_date = $daterange[1] . ' 23:59:59';
        } else {
            $start_date = date('Y-m-01 00:00:00');
            $end_date = date('Y-m-t 23:59:59');
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
