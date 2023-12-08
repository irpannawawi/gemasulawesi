<?php

namespace App\Http\Controllers;

use App\Models\Editorcoice;
use App\Models\Headlinerubrik;
use App\Models\Headlinewp;
use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Tags;
use App\Models\Topic;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewView;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;
use Sarfraznawaz2005\VisitLog\Models\VisitLog as VisitLogModel;

class WebController extends Controller
{
    public function subscribe()
    {
    }
    public function index(): View
    {
        VisitLog::save(request()->all());

        $data['editorCohice'] = Editorcoice::where('post_id', '!=', 0)->get();
        $data['headlineWp'] = Headlinewp::where('post_id', '!=', 0)->get();
        $data['topikKhusus'] = Topic::get();

        // posts 1-30
        $data['paginatedPost'] = Posts::orderBy('published_at', 'DESC')
            ->where('status', 'published')
            ->paginate(30);
        $data['beritaTerkini'] = $data['paginatedPost']->split(2);

        // dd($data['beritaTerkini']);
        return view('frontend.web', $data);
    }


    public function indeks(Request $request)
    {
        VisitLog::save($request->all());

        // Cek apakah ada rentang tanggal yang dipilih
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date') . ' 00:00:00';
            $endDate = $request->input('end_date') . ' 23:59:59';

            $data['paginatedPost'] = Posts::where('status', 'published')
                ->where('published_at', '>=', $startDate)
                ->where('published_at', '<=', $endDate)
                ->orderBy('published_at', 'DESC')
                ->paginate(10);
        } else {
            // Jika tidak ada tanggal yang dipilih, tampilkan semua berita
            $latestPosts = Posts::where('status', 'published')
                ->orderBy('published_at', 'DESC')
                ->limit(10000)
                ->get();

            // Paginate the latest posts with 10 posts per page
            $paginatedPosts = $this->paginate($latestPosts, 10);

            $data['paginatedPost'] = $paginatedPosts;
        }

        $data['beritaTerkini'] = $data['paginatedPost']->split(2);

        return view('frontend.indeks', $data);
    }

    private function paginate($items, $perPage)
    {
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $items->slice(($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, $items->count(), $perPage);
        $paginatedItems->setPath(\Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath());
        return $paginatedItems;
    }

    public function showCategory(): View
    {
        VisitLog::save(request()->all());

        $data['editorCohice'] = Editorcoice::get();
        return view('frontend.web', $data);
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
        $data['paginatedPost'] = Posts::orderBy('published_at', 'DESC')
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
        return view('frontend.singlepost', $data);
    }

    public function category($rubrik_name): View
    {
        $rubrik = Rubrik::where('rubrik_name', $rubrik_name)->get()[0];
        $data['rubrik_name'] = $rubrik_name;
        $data['headlineRubrik'] = Headlinerubrik::where('rubrik_id', $rubrik->rubrik_id)->get();
        $data['topikKhusus'] = Topic::get();

        // posts 1-20
        $data['paginatedPost'] = Posts::orderBy('published_at', 'DESC')
            ->where(['status' => 'published', 'category' => $rubrik->rubrik_id])
            ->paginate(20);
        $data['beritaTerkini'] = $data['paginatedPost']->split(2);
        return view('frontend.category', $data);
    }

    public function topikKhusus($topic_id, $slug)
    {
        // Lakukan logika Anda di sini
        $topic = Topic::where('topic_id', $topic_id)->get()[0];

        $data['topikKhusus'] = Topic::where('topic_id', $topic->topic_id)->get();

        // posts 1-20
        $data['paginatedPost'] = Posts::orderBy('published_at', 'DESC')
            ->where(['status' => 'published'])
            ->where('topics', 'LIKE', '%' . $topic->topic_id . '%')
            ->paginate(20);
        $data['beritaTerkini'] = $data['paginatedPost'];

        return view('frontend.topik', $data);
    }

    public function tags($tag_name): View
    {
        $tag_id = Tags::where('tag_name', $tag_name)->get()[0]->tag_id;

        $data['tag_name'] = $tag_name;
        $data['topikKhusus'] = Topic::get();

        // posts 1-20
        $data['paginatedPost'] = Posts::orderBy('published_at', 'DESC')
            ->where(
                [
                    ['status', '=', 'published'],
                    ['tags', 'like', '%,' . $tag_id . ',%']
                ]
            )
            ->orWhere(
                [
                    ['status', '=', 'published'],
                    ['tags', 'like', '[' . $tag_id . ',%']
                ]
            )
            ->orWhere(
                [
                    ['status', '=', 'published'],
                    ['tags', 'like', '%,' . $tag_id . ']']
                ]
            )
            ->paginate(10);
        $data['beritaTerkini'] = $data['paginatedPost']->split(2);
        return view('frontend.tags', $data);
    }

    public function search(Request $request): View
    {
        $keyword = $request->input('q');

        $paginatedPost = Posts::search($keyword)->paginate(10);

        $beritaTerkini = $paginatedPost->split(2);

        // Tambahkan parameter pencarian ke setiap tautan pagination
        $paginatedPost->appends(['q' => $keyword]);

        return view('frontend.search', compact('paginatedPost', 'beritaTerkini', 'keyword'));
    }
}
