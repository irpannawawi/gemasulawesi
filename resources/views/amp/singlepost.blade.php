@extends('amp.layouts.web')
@section('content')
    <!-- Breadcrumbs -->
    <div class="container">
    </div>
    
    <div class="main-container container" id="main-container">
        
        <!-- Content -->
        <div class="row" style="padding: 8px">
            
            <!-- post content -->
            <div class="col-lg-8 blog__content mb-3">
                <x-amp-ads position='above_content' />

                <ul class="breadcrumbs">
                    <li class="breadcrumbs__item">
                        <a href="{{ url('/') }}" class="breadcrumbs__url"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="20" height="20" viewBox="0 0 50 50">
                                <path
                                    d="M 25 1.0507812 C 24.7825 1.0507812 24.565859 1.1197656 24.380859 1.2597656 L 1.3808594 19.210938 C 0.95085938 19.550938 0.8709375 20.179141 1.2109375 20.619141 C 1.5509375 21.049141 2.1791406 21.129062 2.6191406 20.789062 L 4 19.710938 L 4 46 C 4 46.55 4.45 47 5 47 L 19 47 L 19 29 L 31 29 L 31 47 L 45 47 C 45.55 47 46 46.55 46 46 L 46 19.710938 L 47.380859 20.789062 C 47.570859 20.929063 47.78 21 48 21 C 48.3 21 48.589063 20.869141 48.789062 20.619141 C 49.129063 20.179141 49.049141 19.550938 48.619141 19.210938 L 25.619141 1.2597656 C 25.434141 1.1197656 25.2175 1.0507812 25 1.0507812 z M 35 5 L 35 6.0507812 L 41 10.730469 L 41 5 L 35 5 z">
                                </path>
                            </svg></a>
                    </li>
                    <li class="breadcrumbs__item">
                        <a href="{{ route('category', ['rubrik_name' => Str::slug($post->rubrik->rubrik_name)]) }}"
                            class="breadcrumbs__url">{{ $post->rubrik->rubrik_name }}</a>
                    </li>
                </ul>
                <div class="meta-single-post">
                    <h1 class="title-single-post single-post__title-single-post">
                        {{ $post->title }}
                    </h1>
                    <div class="entry__meta-holder">
                        <ul class="entry__meta">
                            <li class="entry__meta-author">
                                <span>Tim Gema</span>
                            </li>
                            <li class="entry__meta-date">
                                {{ convert_date_to_ID($post->created_at) }}
                            </li>
                        </ul>
                    </div>
                <x-amp-ads position='above_content' />

                    <!-- Entry Image -->
                    <div class="thumb image-single-post">
                        <amp-img src="{{ get_post_image($post->post_id) }}" alt="{{ $post->title }}" height="320"
                            width="480" layout="responsive"></amp-img>
                        <p class="photo__caption">{!! !empty($post->image) ? strip_tags($post->image->caption) : '' !!}</p>
                    </div>
                </div>

                <!-- standard post -->
                <article class="entry mb-0">
                    <div class="entry__article-wrap mt-0">
                        <div class="entry__article">
                            <article class="read__content">
                                @php
                                    $article = $post->article;
                                    $article = str_replace('../', '' . url('') . '/', $article);

                                    $dom = new DOMDocument();
                                    // Muat string HTML ke dalam objek DOMDocument
                                    $dom->loadHTML($article);

                                    // Ambil semua elemen paragraf
                                    $paragraphs = $dom->getElementsByTagName('p');
                                    // Hitung jumlah paragraf
                                    $totalParagraphs = $paragraphs->length;

                                    // Tentukan jumlah paragraf per bagian
                                    $paragrafPerBagian = ceil($totalParagraphs / 2);

                                    // Bagian pertama
                                    $bagian1 = '';
                                    for ($i = 0; $i < $paragrafPerBagian; $i++) {
                                        $bagian1 .= $dom->saveHTML($paragraphs->item($i));
                                    }

                                    // Bagian kedua
                                    $bagian2 = '';
                                    for ($i = $paragrafPerBagian; $i < $totalParagraphs; $i++) {
                                        $bagian2 .= $dom->saveHTML($paragraphs->item($i));
                                    }
                                @endphp

                                {!! $bagian1 !!}
                                @php
                                $ad = get_ad_content();
                            @endphp
                            @if ($ad != null)
                                <!-- Entry Image (modifikasi untuk menambahkan efek paralaks) -->
                                <div class="parallax"
                                    style="background-image: url('{{ Storage::url('public/ads/' . $ad->value) }}');"
                                    data-velocity="0.5">
                                </div>
                            @endif
                            {!! $bagian2 !!}
                                <!-- halaman -->
                                <div class="halaman">
                                    <div class="halaman__teaser">Halaman: </div>
                                    <div class="halaman__wrap">
                                        @for ($i = 1; $i <= $totalPages; $i++)
                                            <div class="halaman__item">
                                                <a href="{{ route('singlePost', [
                                                    'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                                    'post_id' => $post->post_id,
                                                    'slug' => $post->slug,
                                                    'page' => $i,
                                                ]) }}"
                                                    class="pagination__page {{ $currentPage == $i ? 'pagination__page--current' : '' }}">
                                                    {{ $i }}
                                                </a>
                                            </div>
                                        @endfor
                                        <div class="halaman__all">
                                            @if ($currentPage < $totalPages)
                                                <a href="{{ route('singlePost', [
                                                    'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                                    'post_id' => $post->post_id,
                                                    'slug' => $post->slug,
                                                    'page' => $currentPage + 1,
                                                ]) }}"
                                                    class="halaman__selanjutnya">Selanjutnya</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="croslink">
                                    <a href="https://news.google.com/search?q=gemasulawesi.com&hl=id&gl=ID&ceid=ID%3Aid"
                                        target="_blank" rel="noopener noreferrer">Ikuti Update Berita Terkini Gemasulawesi
                                        di: <strong>Google News</strong></a>
                                </div>

                                <div class="editor__text">
                                    <span>Penulis: <a href="{{route('author', ['id'=>$post->author_id, 'name'=>$post->author->display_name])}}">{{ $post->author->display_name }}</a></span>
                                </div>

                                <!-- tags -->
                                <div class="entry__tags">
                                    <span class="entry__tags-label">Tags:</span>

                                    @php
                                        if ($post->tags != null and $post->tags != 'null') {
                                            foreach (json_decode($post->tags) as $tags) {
                                                $tag = \App\Models\Tags::find($tags);
                                                echo '<a href="' . route('tags', ['tag_name' => $tag->tag_name]) . '" rel="tag">' . $tag->tag_name . '</a>';
                                            }
                                        }
                                    @endphp
                                </div> <!-- end tags -->
                            </article>

                        </div> <!-- end entry article -->
                    </div> <!-- end entry article wrap -->


                </article> <!-- end standard post -->

                @if ($post->allow_comment == 1)
                    <x-comment />
                @endif
            </div> <!-- end post content -->

            <!-- end sidebar -->

        </div> <!-- end content -->
        <x-amp-ads position='below_content' />

        <div class="row bottom-widget" style="margin-top: 12px;">
            @if ($post->related_articles != null and $post->related_articles != 'null')
                <div class="berita-terkini-container">
                    <div class="berita-terkini-title">
                        <h2>Artikel terkait</h2>
                    </div>
                    <div class="berita-terkini">
                        <ol class="list-berita">
                            @foreach (json_decode($post->related_articles) as $related)
                                @php
                                    $related = \App\Models\Posts::find($related);
                                @endphp
                                <li>
                                    <a href="{{ route('singlePost', [
                                        'rubrik' => Str::slug($related->rubrik->rubrik_name),
                                        'post_id' => $related->post_id,
                                        'slug' => $related->slug,
                                    ]) }}"
                                        class="terkait__link">{{ $related->title }}</a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @endif
            <div class="berita-terkini-container" style="margin-top: 12px;">

                <div class="berita-terkini-title">
                    <h2>Berita Terkini</h2>
                </div>
                <div class="berita-terkini">
                    @foreach ($beritaTerkini as $post_item)
                        @php
                            $currentPostId = request()->segment(3);
                            $isCurrentPost = $currentPostId == $post_item->post_id;
                        @endphp
                        @if (!$isCurrentPost)
                            <div class="berita-terkini-items">
                                <div class="berita-terkini-img">
                                    <a
                                        href="{{ route('singlePost', [
                                            'rubrik' => Str::slug($post_item->rubrik->rubrik_name),
                                            'post_id' => $post_item->post_id,
                                            'slug' => $post_item->slug,
                                        ]) }}">
                                        <amp-img src="{{ get_post_image($post_item->post_id) }}" alt="{{ $post->title }}"
                                            class="lazyload" class="" height="100" width="100">
                                    </a>
                                </div>
                                <div class="title-post">
                                    <a href="{{ route('singlePost', [
                                        'rubrik' => Str::slug($post_item->rubrik->rubrik_name),
                                        'post_id' => $post_item->post_id,
                                        'slug' => $post_item->slug,
                                    ]) }}"
                                        class="post-title"><b>{{ $post_item->title }}</b></a>
                                    <p class="bt__date"><small>{{ convert_date_to_ID($post_item->created_at) }}</small></p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <x-amp-ads position='footer' />
            
        </div>
    </div>
@endsection
