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
                            <span>Indeks Berita</span>
                        </div>
                        <div class="filter-box">
                            <span>Lihat Berdasarkan Tanggal</span>
                            <div id="reportrange" class="filter__date">
                                <i class="fa-solid fa-caret-down"></i>
                                <span id="daterange"></span>
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <input type="hidden" id="selectedStartDate" name="start_date">
                            <input type="hidden" id="selectedEndDate" name="end_date">
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="post-list-small post-list-small--2 mb-32">
                                    @if (isset($beritaTerkini[0]))
                                        @foreach ($beritaTerkini[0] as $post)
                                            <li class="post-list-small__item">
                                                <article class="post-list-small__entry clearfix">
                                                    <div class="post__img">
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
                                                    <div class="post-list-small__body">
                                                        <ul class="entry__meta category underline">
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
                                    @endif
                                </ul>

                                <!-- Ad Banner 728 -->
                                <div class="text-center pb-48">
                                    <a href="#">
                                        <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg"
                                            alt="">
                                    </a>
                                </div>

                                <ul class="post-list-small post-list-small--2 mb-32">
                                    @if (isset($beritaTerkini[0]))
                                        @foreach ($beritaTerkini[1] as $post)
                                            <li class="post-list-small__item">
                                                <article class="post-list-small__entry clearfix">
                                                    <div class="post__img">
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
                                                    <div class="post-list-small__body">
                                                        <ul class="entry__meta category underline">
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
                                    @endif
                                </ul>
                                <div class="paging paging--page">
                                    {{ $paginatedPost->onEachSide(1)->links() }}
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
    </div> <!-- end main container -->
@endsection
