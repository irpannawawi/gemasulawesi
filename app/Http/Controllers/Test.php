<?php 
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
    $paragraphsPerPage = 10; // Ubah nilai ini sesuai dengan kebutuhan

    // Menandai paragraf
    $currentPage = $request->query('page', 1);

    $filteredParagraphs = array_filter($paragraphs, function ($paragraph) {
        return strpos($paragraph, '<p>Baca Juga:<a ') === false;
    });

    // Menandai paragraf
    $currentPage = $request->query('page', 1);
    $pagedParagraphs = array_slice($filteredParagraphs, ($currentPage - 1) * $paragraphsPerPage, $paragraphsPerPage);
    $post->article = implode('</p>', $pagedParagraphs);

    $data['post'] = $post;
    $data['currentPage'] = $currentPage;
    $data['totalPages'] = ceil(count($filteredParagraphs) / $paragraphsPerPage);
    return view('frontend.singlepost', $data);
} ?>