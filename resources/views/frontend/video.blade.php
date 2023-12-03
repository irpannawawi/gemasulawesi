@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">
        <!-- Content -->
        <div class="row row-20">

            <!-- slider -->
            <div class="col-lg-8 order-lg-2">

                <section>
                    <div class="title-list-berita">
                        <span>Berita Video - {{ get_setting('title') }}</span>
                    </div>
                    {{-- Headline Rubrik --}}
                    <div class="thumb mb-4">
                        {{-- Tampilan mobile --}}
                        <article class="entry thumb--size-3 mb-0">
                            <div class="entry__img-holder thumb__img-holder" style="background-image: url('#');">
                                <h4 class="hl__b-subtitle">
                                    <a href="#" class="hl__link">Title</a>
                                </h4>
                                <div class="bottom-gradient rubrik"></div>
                                <div class="thumb-text-holder rubrik thumb-text-holder--2">
                                    <ul class="entry__meta">
                                        <li>
                                            <a href="#"
                                                class="entry__meta-category entry__meta-category--label entry__meta-category--tosca">Kategori</a>
                                        </li>
                                    </ul>
                                    <h2 class="title-category">
                                        <a href="#">Title</a>
                                    </h2>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-comments">
                                            <a> Tanggal </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                        {{-- Tampilan pc --}}
                        <article class="thumb-text-down">
                            <div class="hl__b-title">
                                <a href="#" class="hl__link">Title</a>
                            </div>
                            <ul class="entry__meta">
                                <li class="entry__meta-comments">
                                    <a> Tanggal </a>
                                </li>
                            </ul>
                        </article>
                    </div>
                    {{-- Headline rubrik --}}

                    <!-- Berita Terkini -->
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <span>Berita Terkini</span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="post-list-small post-list-small--2 mb-32">
                                    <li class="post-list-small__item">
                                        <article class="post-list-small__entry clearfix">
                                            <div class="post__img">
                                                <a href="#">
                                                    <img data-src="#" src="{{ url('assets/frontend') }}/img/empty.jpg"
                                                        alt="Title" class="lazyload">
                                                </a>
                                            </div>
                                            <div class="post-list-small__body">
                                                <ul class="entry__meta category underline">
                                                    <li>
                                                        <a href="#" class="entry__meta-category">Kategori</a>
                                                    </li>
                                                </ul>
                                                <h3 class="post-list-small__entry-title">
                                                    <a href="#" class="post-title">Title</a>
                                                </h3>
                                                <p class="bt__date">Tanggal</p>
                                            </div>
                                        </article>
                                    </li>
                                </ul>
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
