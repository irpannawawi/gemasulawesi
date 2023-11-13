@extends('layouts.other')
@section('content')
    <div class="main-container container" id="main-container">

        <!-- Content -->
        <div class="row row-20">

            <!-- slider -->
            <div class="col-lg-8 order-lg-2">

                <section>
                    <!-- Pencarian -->
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <span>Pencarian</span>
                        </div>
                        <!-- Search form -->
                        <form class="form-inline search mt-3" action="{{ route('search') }}">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input class="form-control form-control-sm ml-3" name="q" type="text"
                                value="{{ request('q') }}" placeholder="Cari" aria-label="Search">
                        </form>
                        @if ($posts->count() > 0)
                            <div class="result-search">
                                <p>Hasil pencarian <strong>"{{ $keyword }}"</strong></p>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <ul class="post-list-small post-list-small--2 mb-32">
                                        @foreach ($posts as $post)
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
                                                                <img data-src="{{ get_post_image($post->post_id) }}"
                                                                    src="{{ url('assets/frontend') }}/img/empty.png"
                                                                    alt="" class="lazyload">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="post-list-small__body">
                                                        <ul class="entry__meta category underline">
                                                            <li>
                                                                <a href="{{ route('category', ['rubrik_name' => $post->rubrik?->rubrik_name]) }}"
                                                                    class="entry__meta-category">{{ $post->rubrik?->rubrik_name }}</a>
                                                            </li>
                                                        </ul>
                                                        <h3 class="post-list-small__entry-title">
                                                            <a href="{{ route('singlePost', [
                                                                'rubrik' => $post->rubrik?->rubrik_name,
                                                                'post_id' => $post->post_id,
                                                                'slug' => $post->slug,
                                                            ]) }}"
                                                                class="">{{ $post->title }}</a>
                                                        </h3>
                                                        <p class="bt__date">{{ convert_date_to_ID($post->created_at) }}</p>
                                                    </div>
                                                </article>
                                            </li>
                                        @endforeach
                                        <div class="text-center pb-48">
                                            <a href="#">
                                                <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg"
                                                    alt="">
                                            </a>
                                        </div>
                                        @foreach ($posts as $post)
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
                                                                <img data-src="{{ get_post_image($post->post_id) }}"
                                                                    src="{{ url('assets/frontend') }}/img/empty.png"
                                                                    alt="" class="lazyload">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="post-list-small__body">
                                                        <ul class="entry__meta category underline">
                                                            <li>
                                                                <a href="{{ route('category', ['rubrik_name' => $post->rubrik?->rubrik_name]) }}"
                                                                    class="entry__meta-category">{{ $post->rubrik?->rubrik_name }}</a>
                                                            </li>
                                                        </ul>
                                                        <h3 class="post-list-small__entry-title">
                                                            <a href="{{ route('singlePost', [
                                                                'rubrik' => $post->rubrik?->rubrik_name,
                                                                'post_id' => $post->post_id,
                                                                'slug' => $post->slug,
                                                            ]) }}"
                                                                class="">{{ $post->title }}</a>
                                                        </h3>
                                                        <p class="bt__date">{{ convert_date_to_ID($post->created_at) }}</p>
                                                    </div>
                                                </article>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- Ad Banner 728 -->
                                </div>
                            </div>
                            <div class="loadmore">
                                {{-- {{ $paginatedPost->onEachSide(1)->links() }} --}}
                                <p>tes</p>
                            </div>
                        @else
                            <div class="result-search">
                                <p>Tidak ada hasil yang ditemukan untuk pencarian <strong>"{{ $keyword }}"</strong>
                                </p>
                            </div>
                        @endif
                    </div>
                </section>
            </div> <!-- end slider -->

            <!-- Sidebar -->
            <x-sidebar />
            <!-- end sidebar -->
        </div> <!-- end content -->
    </div> <!-- end main container -->
@endsection
