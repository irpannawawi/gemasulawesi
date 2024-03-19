<?php

namespace App\Http\Controllers;

use App\Models\Editorcoice;
use App\Models\Headlinerubrik;
use App\Models\Headlinewp;
use App\Models\Posts;
use App\Models\Rubrik;
use App\Models\Source;
use App\Models\Tags;
use App\Models\Topic;
use App\Models\User;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewView;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;
use App\Models\Visitlg;
use Sarfraznawaz2005\VisitLog\Models\VisitLog as VisitLogModel;

class WebController extends Controller
{
    public function subscribe()
    {
    }
    public function index(): View
    {
        VisitLog::save(request()->all());

        $data['editorCohice'] = Cache::remember('editorChoice', 120, function () {
            return Editorcoice::with(['post.rubrik', 'post.image.asset'])->where('post_id', '!=', 0)->get();
        });
        $data['headlineWp'] = Cache::remember('headlineWp', 120, function () {
            return Headlinewp::with(['post.rubrik', 'post.image.asset'])->where('post_id', '!=', 0)->get();
        });
        $data['topikKhusus'] = Cache::remember('topikKhusus', 120, function () {
            return Topic::get();
        });

        // posts 1-30
        $data['paginatedPost'] = Cache::remember('index_paginated_posts', 70, function () {
            return Posts::orderBy('published_at', 'DESC')
                ->where('status', 'published')
                ->with(['rubrik', 'image.asset'])
                ->paginate(30);
        });
        $data['beritaTerkini'] = $data['paginatedPost']->split(2);

        // dd($data['beritaTerkini']);
        return view('frontend.web', $data);
    }


    public function indeks(Request $request)
    {

        VisitLog::save($request->all());

        // Cek apakah ada rentang tanggal yang dipilih
        if ($request->has('start_date') && $request->has('end_date')) {
            // jika ada tanggal yang dipilih, tampilkan berita sesuai rentang
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
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $currentItems = $items->forPage($currentPage, $perPage);
        $paginatedItems = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, $items->count(), $perPage);
        $paginatedItems->setPath(\Illuminate\Pagination\Paginator::resolveCurrentPath());
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
        $this->count_visit();
        $logResult = VisitLog::save(request()->all());
        if (is_array($logResult) && isset($logResult['type']) && $logResult['type'] == 'create') {
            $post = Posts::find($post_id);
            $post->visit += 1;
            $post->save();
        }

        $rubrik = Cache::remember('rubrik_' . str_replace('-', ' ', $rubrik_name), env('CACHE_DURATION'), function () use ($rubrik_name) {
            return Rubrik::where('rubrik_name', str_replace('-', ' ', $rubrik_name))->first();
        });

        if ($rubrik != null) {
            $rubrik_id = $rubrik->rubrik_id;
        } else {
            $rubrik_id = 0;
        }

        $post = Cache::remember('post' . $post_id, env('CACHE_DURATION'), function () use ($post_id) {
            return Posts::with(['rubrik'])->where(['post_id' => $post_id])->first();
        });

        if ($post == null) {
            return abort(404);
        }
        if ($post->status == 'trash') {
            return abort(404);
        }

        $data['paginatedPost'] = Cache::remember('posts_list' . $post_id, env('CACHE_DURATION'), function () {
            return Posts::orderBy('published_at', 'DESC')
                ->with(['rubrik'])
                ->where('status', 'published')
                ->limit(10)->get();
        });

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
        $rubrik_name = Str::replace('-', ' ', $rubrik_name);
        $rubrik = Rubrik::where('rubrik_name', $rubrik_name)->first();
        if (!$rubrik) {
            return abort(404);
        }

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

    public function tags($tag_name)
    {

        if (strpos($tag_name, '%20') !== false || strpos($tag_name, ' ') !== false) {
            // string contains '%20' or space
            return redirect()->route('tags', ['tag_name' => Str::replace(' ', '-', Str::replace('%20', '-', ($tag_name)))]);
        }

        $tag_name = Str::replace('-', ' ', $tag_name);
        $tag = Tags::where('tag_name', $tag_name)->first();
        if (!$tag || $tag == null) {
            return abort(404);
        }

        $tag_id = $tag->tag_id;
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

            ->orWhere(
                [
                    ['status', '=', 'published'],
                    ['tags', 'like', '%"' . $tag_id . '"%']
                ]
            )
            ->orWhere(
                [
                    ['status', '=', 'published'],
                    ['tags', 'like', '["' . $tag_id . '",%']
                ]
            )
            ->orWhere(
                [
                    ['status', '=', 'published'],
                    ['tags', 'like', '%,"' . $tag_id . '"]']
                ]
            )
            ->orWhere(
                [
                    ['status', '=', 'published'],
                    ['tags', 'like', '%' . $tag_id . '%']
                ]
            )

            ->paginate(15);

        if (count($data['paginatedPost']) == 0) {
            return abort(404);
        }

        $data['beritaTerkini'] = $data['paginatedPost']->split(2);
        return view('frontend.tags', $data);
    }


    public function author($id, $name): View
    {
        $data['author'] = User::find($id);

        $data['author_name'] = $data['author']->display_name;
        $data['topikKhusus'] = Topic::get();

        // posts 1-20
        $data['paginatedPost'] = Posts::orderBy('published_at', 'DESC')
            ->where(
                [
                    ['status', '=', 'published'],
                    ['author_id', '=', $id]
                ]
            )
            ->paginate(10);
        $data['beritaTerkini'] = $data['paginatedPost']->split(2);
        return view('frontend.author', $data);
    }

    public function search(Request $request): View
    {
        $keyword = $request->input('q');

        $paginatedPost = Posts::orderBy('published_at', 'desc');
        if ($keyword != '') {
            $paginatedPost = $paginatedPost->where([
                ['title', 'like', '%' . $keyword . '%'],
                ['article', 'like', '%' . $keyword . '%']
            ])->orWhere([
                ['title', 'like', '%' . $keyword . '%']
            ]);
        }
        $paginatedPost = $paginatedPost->where('status', 'published')->paginate(10);

        $beritaTerkini = $paginatedPost->split(2);

        // Tambahkan parameter pencarian ke setiap tautan pagination
        $paginatedPost->appends(['q' => $keyword]);

        return view('frontend.search', compact('paginatedPost', 'beritaTerkini', 'keyword'));
    }

    public function news_xml()
    {
        $posts = Posts::where('status', 'published')->orderBy('published_at', 'desc')->get();

        return response()->view('sitemap.google.news', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }

    public function count_visit()
    {

        if (Visitlg::count() > 6000) {
            Visitlg::truncate();
        }
        return null;
    }
}
