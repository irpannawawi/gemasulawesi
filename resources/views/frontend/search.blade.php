@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">

        <!-- Content -->
        <div class="row row-20">

            <!-- slider -->
            <div class="col-lg-8 order-lg-2">

                <section>
                    <!-- Pencarian -->
                    <div class="berita-terkini">
                        <div class="title-wrap title-wrap--line">
                            <h3 class="section-title">Pencarian</h3>
                        </div>
                        <!-- Search form -->
                        <form class="form-inline search">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input class="form-control form-control-sm ml-3" type="text" placeholder="Cari"
                                aria-label="Search">
                        </form>
                        <div class="result-search">
                            <p>Hasil pencarian <strong>"Result"</strong></p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="post-list-small post-list-small--2 mb-32">
                                    <li class="post-list-small__item">
                                        <article class="post-list-small__entry clearfix">
                                            <div class="post-list-small__img-holder">
                                                <div class="thumb-container thumb-70">
                                                    <a href="">
                                                        <img data-src="#link image"
                                                            src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                            class=" lazyload">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-list-small__body">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="#link category" class="entry__meta-category">Category</a>
                                                    </li>
                                                </ul>
                                                <h3 class="post-list-small__entry-title">
                                                    <a href="#">Film horor Ready or Not adalah film horor yang dirilis
                                                        pada tahun 2019 dengan menghadirkan dua bintang utama.</a>
                                                </h3>
                                                <p class="bt__date">Senin, 3 Juli 2023 | 21:47 WIB</p>
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
    </div> <!-- end main container -->
@endsection
