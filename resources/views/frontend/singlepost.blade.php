@extends('layouts.web')
@section('content')
    <!-- Breadcrumbs -->
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ url('/') }}" class="breadcrumbs__url"><i class="fa-solid fa-house"></i></a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('category', ['rubrik_name' => $post->rubrik->rubrik_name]) }}"
                    class="breadcrumbs__url">{{ $post->rubrik->rubrik_name }}</a>
            </li>
        </ul>
    </div>

    <div class="main-container container" id="main-container">

        <!-- Content -->
        <div class="row">

            <!-- post content -->
            <div class="col-lg-8 blog__content mb-72">
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
                    <div class="social-post socials--medium socials--rounded">
                        <a href="#" class="social social-facebook" aria-label="facebook"><i
                                class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social social-twitter" aria-label="twitter"><i
                                class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" class="social social-youtube" aria-label="youtube"><i
                                class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="social social-instagram" aria-label="instagram"><i
                                class="ui-instagram"></i></a>
                        <a href="#" class="social social-telegram" aria-label="instagram"><i
                                class="fa-brands fa-telegram"></i></a>
                    </div>
                </div>
                <!-- Entry Image -->
                {{-- <div class="thumb image-single-post">
                    <div class="entry__img-holder thumb__img-holder"
                        style="background-image: url('{{ get_string_between($post->article, '<img src="', '">') }}');">
                    </div>
                    <p class="photo__caption">Photo caption unavailable</p>
                </div> --}}

                <!-- standard post -->
                <article class="entry mb-0">
                    <div class="entry__article-wrap mt-0">
                        <div class="entry__article">
                            <article class="read__content">
                                @php
                                    $article = $post->article;
                                    if ($post->tags != null) {
                                        foreach (json_decode($post->tags) as $tags) {
                                            $tag = \App\Models\Tags::find($tags);
                                            $article = str_ireplace($tag->tag_name, "<a href=\"" . route('tags', ['tag_name' => $tag->tag_name]) . "\" >" . $tag->tag_name . '</a>', $article);
                                            // dd($article);
                                        }
                                    }
                                    $article = str_replace('../', '' . url('') . '/', $article);
                                    // echo $article;
                                @endphp
                                {!! $article !!}
                                <!-- halaman -->
                                <div class="halaman">
                                    <divs class="halaman__teaser">Halaman: </divs>
                                    <div class="halaman__wrap">
                                        <div class="halaman__item">
                                            <span class="pagination__page pagination__page--current">1</span>
                                        </div>
                                        <div class="halaman__item">
                                            <a href="#" class="pagination__page">2</a>
                                        </div>
                                        <div class="halaman__all">
                                            <a href="#" class="halaman__selanjutnya">Selanjutnya</a>
                                        </div>
                                    </div>
                                </div>
                                <p>Editor: <a>Mitha Paradilla Rayadi</a></p>

                                <!-- tags -->
                                <div class="entry__tags">
                                    <i class="ui-tags"></i>
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

                    <!-- Related Posts -->
                    <section class="section mt-40 mb-0">
                        <div class="title-wrap title-wrap--line">
                            <h4 style="text-align: center">SHARE:</h4>
                            <div class="social-post socials--medium socials--rounded">
                                <a href="#" class="social social-facebook" aria-label="facebook"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="social social-twitter" aria-label="twitter"><i
                                        class="fa-brands fa-x-twitter"></i></a>
                                <a href="#" class="social social-youtube" aria-label="youtube"><i
                                        class="fa-brands fa-youtube"></i></a>
                                <a href="#" class="social social-instagram" aria-label="instagram"><i
                                        class="ui-instagram"></i></a>
                                <a href="#" class="social social-telegram" aria-label="instagram"><i
                                        class="fa-brands fa-telegram"></i></a>
                            </div>
                        </div>

                    </section> <!-- end related posts -->

                </article> <!-- end standard post -->

                @if ($post->allow_comment == 1)
                    <x-comment />
                @endif
            </div> <!-- end post content -->

            <!-- Sidebar -->
            <x-sidebar />
            <!-- end sidebar -->

        </div> <!-- end content -->

        <div class="row row-20">
            @if ($post->related_articles != null and $post->related_articles != 'null')
                <div class="col-lg-8 order-lg-2">

                    <div class="title-post">
                        <span>Berita Terkait</span>
                    </div>
                    <div class="berita__terkait">
                        <ul class="terkait__list">
                            @foreach (json_decode($post->related_articles) as $related)
                                @php
                                    $related = \App\Models\Posts::find($related);
                                @endphp
                                <li>
                                    <h2 class="terkait__title">
                                        <a href="{{ route('singlePost', [
                                            'rubrik' => $related->rubrik->rubrik_name,
                                            'post_id' => $related->post_id,
                                            'slug' => $related->slug,
                                        ]) }}"
                                            class="terkait__link">{{ $related->title }}</a>
                                    </h2>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="col-lg-8 order-lg-2 mt-4">

                <div class="title-post">
                    <span>Berita Terkini</span>
                </div>
                <div class="row">
                    <div class="col">
                        @foreach ($beritaTerkini as $post)
                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a
                                                    href="{{ route('singlePost', [
                                                        'rubrik' => $post->rubrik->rubrik_name,
                                                        'post_id' => $post->post_id,
                                                        'slug' => $post->slug,
                                                    ]) }}">
                                                    <img data-src="{{str_replace('../',url('/').'/',get_string_between($post->article, '<img src="', '">'))}}"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <h3 class="post-list-small__entry-title">
                                                <a href="{{ route('singlePost', [
                                                    'rubrik' => $post->rubrik->rubrik_name,
                                                    'post_id' => $post->post_id,
                                                    'slug' => $post->slug,
                                                ]) }}"
                                                    class="post-title">{{ $post->title }}</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB </p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
