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
                        <div class="title-sidebar">
                            <span>Pencarian</span>
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
                                                    <a href="#" class="">Film horor Ready or Not adalah film
                                                        horor yang dirilis
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
            <x-sidebar />
            <!-- end sidebar -->
        </div> <!-- end content -->
    </div> <!-- end main container -->
@endsection
