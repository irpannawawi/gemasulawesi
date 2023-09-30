@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">

        <!-- Content -->
        <div class="row row-20">

            <!-- slider -->
            <div class="col-lg-8 order-lg-2">

                <section>
                    <div class="title-wrap">
                        <h3 class="section-title mb-3">{{$rubrik_name}}</h3>
                    </div>
                    <div class="thumb image-single-post">
                        <div>
                            <article class="entry thumb--size-3 mb-0">
                                <div class="entry__img-holder thumb__img-holder"
                                    style="background-image: url('{{ get_string_between($headlineRubrik->post->article, '<img src="', '">') }}');">
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder thumb-text-holder--2">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="{{route('category', ['rubrik_name'=>$headlineRubrik->post->rubrik->rubrik_name])}}"
                                                    class="entry__meta-category entry__meta-category--label entry__meta-category--tosca">{{ $headlineRubrik->post->rubrik->rubrik_name }}</a>
                                            </li>
                                        </ul>
                                        <h2 class="thumb-entry-title">
                                            <a
                                                href="{{ route('singlePost', [
                                                    'rubrik' => $headlineRubrik->post->rubrik->rubrik_name,
                                                    'post_id' => $headlineRubrik->post->post_id,
                                                    'slug' => $headlineRubrik->post->slug,
                                                ]) }}">{{ $headlineRubrik->post->title }}</a>
                                        </h2>
                                        <ul class="entry__meta">
                                            <li class="entry__meta-comments">
                                                <a> {{convert_date_to_ID($headlineRubrik->created_at)}} </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <!-- Berita Terkini -->
                    <div class="berita-terkini">
                        <div class="title-wrap title-wrap--line">
                            <h3 class="section-title">Berita Terkini</h3>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="post-list-small post-list-small--2 mb-32">
                                    @foreach ($beritaTerkini as $post)
                                    <li class="post-list-small__item">
                                        <article class="post-list-small__entry clearfix">
                                            <div class="post-list-small__img-holder">
                                                <div class="thumb-container thumb-70">
                                                    <a href="{{route('singlePost', [
                                                        'rubrik'=>$post->rubrik->rubrik_name,
                                                        'post_id'=>$post->post_id,
                                                        'slug'=>$post->slug
                                                    ])}}">
                                                        <img data-src="{{get_string_between($post->article, '<img src="', '">')}}"
                                                            src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                            class=" lazyload">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-list-small__body">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="{{route('category', ['rubrik_name'=>$post->rubrik->rubrik_name])}}" class="entry__meta-category">{{$post->rubrik->rubrik_name}}</a>
                                                    </li>
                                                </ul>
                                                <h3 class="post-list-small__entry-title">
                                                    <a href="{{route('singlePost', [
                                                        'rubrik'=>$post->rubrik->rubrik_name,
                                                        'post_id'=>$post->post_id,
                                                        'slug'=>$post->slug
                                                    ])}}">{{$post->title}}</a>
                                                </h3>
                                                <p class="bt__date">{{convert_date_to_ID($post->created_at)}}</p>
                                            </div>
                                        </article>
                                    </li> 
                                    @endforeach
                                </ul>

                                <!-- Ad Banner 728 -->
                                <div class="text-center pb-48">
                                    <a href="#">
                                        <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg"
                                            alt="">
                                    </a>
                                </div>

                                <x-topik_khusus :$topikKhusus />
                            </div>
                        </div>
                    </div>
                </section>
            </div> <!-- end slider -->

            <!-- Sidebar -->
            <aside class="col-lg sidebar order-lg-3">
                <!-- Widget Popular Posts -->
                <aside class="widget widget-popular-posts">
                    <h4 class="widget-title">Terpopular</h4>
                    <ul class="post-list-small post-list-small--1">
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Barack Obama and Family Visit Balinese
                                            Paddy Fields</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_12.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                            Live. We’re Not Ready</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_12.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                            Live. We’re Not Ready</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_12.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                            Live. We’re Not Ready</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_12.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                            Live. We’re Not Ready</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_12.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                            Live. We’re Not Ready</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_12.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                            Live. We’re Not Ready</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_12.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                            Live. We’re Not Ready</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_12.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                            Live. We’re Not Ready</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-80">
                                        <a href="single-post-politics.html">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_12.jpg"
                                                src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                class=" lazyload">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                            Live. We’re Not Ready</a>
                                    </h3>
                                </div>
                            </article>
                        </li>
                    </ul>
                </aside> <!-- end widget popular posts -->
            </aside> <!-- end sidebar -->
        </div> <!-- end content -->

        {{-- row bawah --}}
        <div class="row row-20">
            <div class="col-lg-8 order-lg-2">
                <section>
                    <div class="row">
                        <div class="col">
                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a href="single-post-politics.html">
                                                    <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_1.jpg"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">Category</a>
                                                </li>
                                            </ul>
                                            <h3 class="post-list-small__entry-title">
                                                <a href="single-post-politics.html">'It's not a concentration
                                                    camp':
                                                    Bangladesh defends plan to house Rohingya on island with
                                                    armed
                                                    police</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a href="single-post-politics.html">
                                                    <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_2.jpg"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">Category</a>
                                                </li>
                                            </ul>
                                            <h3 class="post-list-small__entry-title">
                                                <a href="single-post-politics.html">'It's not a concentration
                                                    camp':
                                                    Bangladesh defends plan to house Rohingya on island with
                                                    armed
                                                    police</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a href="single-post-politics.html">
                                                    <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_3.jpg"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">Category</a>
                                                </li>
                                            </ul>
                                            <h3 class="post-list-small__entry-title">
                                                <a href="single-post-politics.html">'It's not a concentration
                                                    camp':
                                                    Bangladesh defends plan to house Rohingya on island with
                                                    armed
                                                    police</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a href="single-post-politics.html">
                                                    <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_1.jpg"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">Category</a>
                                                </li>
                                            </ul>
                                            <h3 class="post-list-small__entry-title">
                                                <a href="single-post-politics.html">'It's not a concentration
                                                    camp':
                                                    Bangladesh defends plan to house Rohingya on island with
                                                    armed
                                                    police</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>

                            <!-- Ad Banner 728 -->
                            <div class="text-center pb-48">
                                <a href="#">
                                    <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg"
                                        alt="">
                                </a>
                            </div>

                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a href="single-post-politics.html">
                                                    <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_1.jpg"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">Category</a>
                                                </li>
                                            </ul>
                                            <h3 class="post-list-small__entry-title">
                                                <a href="single-post-politics.html">'It's not a concentration
                                                    camp':
                                                    Bangladesh defends plan to house Rohingya on island with
                                                    armed
                                                    police</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a href="single-post-politics.html">
                                                    <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_2.jpg"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">Category</a>
                                                </li>
                                            </ul>
                                            <h3 class="post-list-small__entry-title">
                                                <a href="single-post-politics.html">'It's not a concentration
                                                    camp':
                                                    Bangladesh defends plan to house Rohingya on island with
                                                    armed
                                                    police</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a href="single-post-politics.html">
                                                    <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_3.jpg"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">Category</a>
                                                </li>
                                            </ul>
                                            <h3 class="post-list-small__entry-title">
                                                <a href="single-post-politics.html">'It's not a concentration
                                                    camp':
                                                    Bangladesh defends plan to house Rohingya on island with
                                                    armed
                                                    police</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a href="single-post-politics.html">
                                                    <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_1.jpg"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">Category</a>
                                                </li>
                                            </ul>
                                            <h3 class="post-list-small__entry-title">
                                                <a href="single-post-politics.html">'It's not a concentration
                                                    camp':
                                                    Bangladesh defends plan to house Rohingya on island with
                                                    armed
                                                    police</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                            <ul class="post-list-small post-list-small--2 mb-32">
                                <li class="post-list-small__item">
                                    <article class="post-list-small__entry clearfix">
                                        <div class="post-list-small__img-holder">
                                            <div class="thumb-container thumb-70">
                                                <a href="single-post-politics.html">
                                                    <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_2.jpg"
                                                        src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                        class=" lazyload">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-list-small__body">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">Category</a>
                                                </li>
                                            </ul>
                                            <h3 class="post-list-small__entry-title">
                                                <a href="single-post-politics.html">'It's not a concentration
                                                    camp':
                                                    Bangladesh defends plan to house Rohingya on island with
                                                    armed
                                                    police</a>
                                            </h3>
                                            <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                            <div class="loadmore">
                                <!-- Pagination -->
                                <nav class="pagination">
                                    <span class="pagination__page pagination__page--current">1</span>
                                    <a href="#" class="pagination__page">2</a>
                                    <a href="#" class="pagination__page">3</a>
                                    <a href="#" class="pagination__page">4</a>
                                    <a href="#" class="pagination__page pagination__icon pagination__page--next"><i
                                            class="ui-arrow-right"></i></a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </section> <!-- end carousel posts -->
            </div>

        </div>
    </div> <!-- end main container -->
@endsection
