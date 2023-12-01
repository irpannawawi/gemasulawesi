<?php

namespace App\Http\Controllers;

use App\Models\Editorcoice;
use App\Models\Headlinerubrik;
use App\Models\Headlinewp;
use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Tags;
use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewView;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;
use Sarfraznawaz2005\VisitLog\Models\VisitLog as VisitLogModel;

class WebAmpController extends Controller
{
    public function index(): View
    {
        VisitLog::save(request()->all());

        $data['editorCohice'] = Editorcoice::get();
        $data['headlineWp'] = Headlinewp::get();
        $data['topikKhusus'] = Topic::get();

        // posts 1-30
        $data['paginatedPost'] = Posts::orderBy('created_at', 'DESC')
            ->where('status', 'published')
            ->paginate(30);
        $data['beritaTerkini'] = $data['paginatedPost']->split(2);

        // dd($data['beritaTerkini']);
        return view('amp.web', $data);
    }

    public function singlePost(Request $request, $rubrik_name, $post_id, $slug): View
    {

        // visitor counter
        // jika ip sudah mengunjungi do nothing
        $logResult = VisitLog::save(request()->all());

        if (is_array($logResult) && isset($logResult['type']) && $logResult['type'] == 'create') {
            $post = Posts::find($post_id);
            $post->visit += 1;
            $post->save();
        }

        $post = Posts::find($post_id);
        $data['paginatedPost'] = Posts::orderBy('created_at', 'DESC')
            ->where('status', 'published')
            ->limit(10)->get();
        $data['beritaTerkini'] = $data['paginatedPost'];

        // Membagi konten artikel menjadi beberapa paragraf
        $paragraphs = preg_split('/<\/p>/', $post->article, -1, PREG_SPLIT_NO_EMPTY);

        // Menentukan jumlah paragraf per halaman
        $paragraphsPerPage = 10; // Ubah nilai ini sesuai dengan kebutuhan.

        // Menandai paragraf
        $currentPage = $request->query('page', 1);
        $pagedParagraphs = array_slice($paragraphs, ($currentPage - 1) * $paragraphsPerPage, $paragraphsPerPage);
        $post->article = implode('</p>', $pagedParagraphs);

        $data['post'] = $post;
        $data['currentPage'] = $currentPage;
        $data['totalPages'] = ceil(count($paragraphs) / $paragraphsPerPage);
        return view('amp.singlepost', $data);
    }
}
