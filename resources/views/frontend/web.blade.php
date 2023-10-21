@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">

        <!-- Content -->
        <div class="row row-20">

            <!-- slider -->
            <div class="col-lg-8 order-lg-2">

                <section>
                    <div class="wrapper-owl">
                        <div class="headline">
                            headline
                        </div>
                        <div class="owl-carousel owl-carousel-thumbs" data-slider-id="5">
                            @foreach ($headlineWp as $headline)
                                <div>
                                    <article class="entry thumb--size-3 mb-0">
                                        <div class="entry__img-holder thumb__img-holder"
                                            style="background-image: url('{{ get_string_between($headline->post->article, '<img src="', '">') }}');">
                                            <div class="bottom-gradient"></div>
                                            <div class="thumb-text-holder thumb-text-holder--2">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="{{ route('category', ['rubrik_name' => $headline->post->rubrik->rubrik_name]) }}"
                                                            class="entry__meta-category entry__meta-category--label entry__meta-category--tosca">{{ $headline->post->rubrik->rubrik_name }}</a>
                                                    </li>
                                                </ul>
                                                <h2 class="thumb-entry-title">
                                                    <a
                                                        href="{{ route('singlePost', [
                                                            'rubrik' => $headline->post->rubrik->rubrik_name,
                                                            'post_id' => $headline->post->post_id,
                                                            'slug' => $headline->post->slug,
                                                        ]) }}">{{ $headline->post->title }}</a>
                                                </h2>
                                                {{-- <ul class="entry__meta">
                                                    <li class="entry__meta-views">
                                                        <i class="ui-eye"></i>
                                                        <span>1356</span>
                                                    </li>
                                                    <li class="entry__meta-comments">
                                                        <a href="#">
                                                            <i class="ui-chat-empty"></i>13
                                                        </a>
                                                    </li>
                                                </ul> --}}
                                            </div>
                                            <a class="thumb-url"></a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="owl-thumbs row mb-3 d-none d-md-flex w-100 mx-auto" data-slider-id="5">
                        @foreach ($headlineWp as $headline)
                            <div class="owl-thumb-item col-3 p-0">
                                <div class="card">
                                    <img src="{{ get_string_between($headline->post->article, '<img src="', '">') }}"
                                        class="card-img-top w-100"
                                        style="object-fit: cover;height: 80px;object-position: top;" alt="">
                                    <div class="card-body">
                                        <a
                                            href="{{ route('singlePost', [
                                                'rubrik' => $headline->post->rubrik->rubrik_name,
                                                'post_id' => $headline->post->post_id,
                                                'slug' => $headline->post->slug,
                                            ]) }}">
                                            {{ Str::limit($headline->post->title, 70) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pilihan-editor">
                        <div class="title-post">
                            <span>Editorial</span>
                        </div>

                        <!-- Slider -->
                        <div class="wrap-owl">
                            <div id="owl-pilihan-editor" class="owl-carousel owl-theme owl-carousel--arrows-outside">
                                @foreach ($editorCohice as $choice)
                                    <article class="entry">
                                        <div class="entry__img-holder">
                                            <a
                                                href="{{ route('singlePost', [
                                                    'rubrik' => $choice->post->rubrik->rubrik_name,
                                                    'post_id' => $choice->post_id,
                                                    'slug' => $choice->post->slug,
                                                ]) }}">
                                                <div class="thumb-container thumb-65">
                                                    <img data-src="{{ get_string_between($choice->post->article, '<img src="', '">') }}"
                                                        src="{{ url('assets/frontend') }}/img/empty.png"
                                                        class="entry__img lazyload" alt="{{ $choice->post->title }}">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="entry__body">
                                            <div class="entry__header">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="{{ route('singlePost', [
                                                            'rubrik' => $choice->post->rubrik->rubrik_name,
                                                            'post_id' => $choice->post_id,
                                                            'slug' => $choice->post->slug,
                                                        ]) }}"
                                                            class="entry__meta-category">{{ $choice->post->rubrik->rubrik_name }}</a>
                                                    </li>
                                                </ul>
                                                <h2 class="entry__title">
                                                    <a
                                                        href="{{ route('singlePost', [
                                                            'rubrik' => strtolower($choice->post->rubrik->rubrik_name),
                                                            'post_id' => $choice->post_id,
                                                            'slug' => $choice->post->slug,
                                                        ]) }}">{{ Str::limit($choice->post->title, 60) }}</a>
                                                </h2>
                                                <p class="bt__date">{{ convert_date_to_ID($choice->post->created_at) }}</p>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div> <!-- end slider -->
                            <div class="wrap-btn-slider">
                                <div class="btn-slider">
                                    <button class="btn-prev" id="prevPost3"><i class="ui-arrow-left"></i></button>
                                    <button class="btn-next" id="nextPost3"><i class="ui-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Berita Terkini -->
                    <div class="berita-terkini">
                        <div class="title-post">
                            <span>Berita Terkini</span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="post-list-small post-list-small--2 mb-32 mt-3">
                                    @foreach ($beritaTerkini[0] as $post)
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
                                                            <img data-src="{{ @get_string_between($post->article, '<img src="', '">') }}"
                                                                src="{{ url('assets/frontend') }}/img/empty.png"
                                                                alt="" class="lazyload">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="post-list-small__body">
                                                    <ul class="entry__meta">
                                                        <li>
                                                            <a href="{{ route('category', ['rubrik_name' => $post->rubrik->rubrik_name]) }}"
                                                                class="entry__meta-category">{{ $post->rubrik->rubrik_name }}</a>
                                                        </li>
                                                    </ul>
                                                    <h3 class="post-list-small__entry-title">
                                                        <a href="{{ route('singlePost', [
                                                            'rubrik' => $post->rubrik->rubrik_name,
                                                            'post_id' => $post->post_id,
                                                            'slug' => $post->slug,
                                                        ]) }}"
                                                            class="post-title">{{ $post->title }}</a>
                                                    </h3>
                                                    <p class="bt__date">{{ convert_date_to_ID($post->post->created_at) }}
                                                    </p>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>

                                <x-topik_khusus :$topikKhusus />

                                <!-- Ad Banner 728 -->
                                <div class="text-center mt-3">
                                    <a href="#">
                                        <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg"
                                            alt="">
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div> <!-- end slider -->

            <!-- Sidebar -->

            <x-sidebar />
            <!-- end sidebar -->

        </div> <!-- end content -->

        {{-- row bawah --}}
        <div class="row row-20 row__bawah">
            <div class="col-lg-8 order-lg-2">
                <section>
                    <div class="row">
                        <div class="col">

                            <ul class="post-list-small post-list-small--2 mb-32">
                                @foreach ($beritaTerkini[0] as $post)
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
                                                        <img data-src="{{ @get_string_between($post->article, '<img src="', '">') }}"
                                                            src="{{ url('assets/frontend') }}/img/empty.png"
                                                            alt="" class=" lazyload">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-list-small__body">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="{{ route('category', ['rubrik_name' => $post->rubrik->rubrik_name]) }}"
                                                            class="entry__meta-category">{{ $post->rubrik->rubrik_name }}</a>
                                                    </li>
                                                </ul>
                                                <h3 class="post-list-small__entry-title">
                                                    <a href="{{ route('singlePost', [
                                                        'rubrik' => $post->rubrik->rubrik_name,
                                                        'post_id' => $post->post_id,
                                                        'slug' => $post->slug,
                                                    ]) }}"
                                                        class="post-title">{{ $post->title }}</a>
                                                </h3>
                                                <p class="bt__date">{{ convert_date_to_ID($post->created_at) }}</p>
                                            </div>
                                        </article>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="loadmore">
                                {{ $paginatedPost->links() }}
                            </div>
                        </div>
                    </div>
                </section> <!-- end carousel posts -->
            </div>

        </div>
    </div> <!-- end main container -->
@endsection
