@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">
        <!-- Content -->
        <div class="row row-20">

            <!-- slider -->
            <div class="col-lg-8 order-lg-2">

                <section>
                    <div class="title-list-berita">
                        <span>{{ $rubrik_name }}</span>
                    </div>
                    <div class="thumb image-single-post mb-4">
                        <div>
                            <article class="entry thumb--size-3 mb-0">
                                <div class="entry__img-holder thumb__img-holder"
                                    style="background-image: url('{{ get_string_between($headlineRubrik->post->article, '<img src="', '">') }}');">
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder thumb-text-holder--2">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="{{ route('category', ['rubrik_name' => $headlineRubrik->post->rubrik->rubrik_name]) }}"
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
                                                <a> {{ convert_date_to_ID($headlineRubrik->created_at) }} </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <!-- Berita Terkini -->
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <span>Berita Terkini</span>
                        </div>
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
                                                                'rubrik' => $post->rubrik?->rubrik_name,
                                                                'post_id' => $post->post_id,
                                                                'slug' => $post->slug,
                                                            ]) }}">
                                                            <img data-src="{{ get_string_between($post->article, '<img src="', '">') }}"
                                                                src="{{ url('assets/frontend') }}/img/empty.png"
                                                                alt="" class=" lazyload">
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
                                                            class="post-title">{{ $post->title }}</a>
                                                    </h3>
                                                    <p class="bt__date">{{ convert_date_to_ID($post->created_at) }}</p>
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
            <x-sidebar />
            <!-- end sidebar -->
        </div> <!-- end content -->

        {{-- row bawah --}}
        <div class="row row-20 mt-3">
            <div class="col-lg-8 order-lg-2">
                <section>
                    <div class="row">
                        <div class="col">
                            <ul class="post-list-small post-list-small--2 mb-32">
                                @foreach ($beritaTerkini[1] as $post)
                                    <li class="post-list-small__item">
                                        <article class="post-list-small__entry clearfix">
                                            <div class="post-list-small__img-holder">
                                                <div class="thumb-container thumb-70">
                                                    <a
                                                        href="{{ route('singlePost', [
                                                            'rubrik' => $post->rubrik?->rubrik_name,
                                                            'post_id' => $post->post_id,
                                                            'slug' => $post->slug,
                                                        ]) }}">
                                                        <img data-src="{{ @get_string_between($post->article, '<img src="', '">') }}"
                                                            src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                            class=" lazyload">
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
                                                        class="post-title">{{ $post->title }}</a>
                                                </h3>
                                                <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                            </div>
                                        </article>
                                    </li>
                                @endforeach
                            </ul>


                            <!-- Ad Banner 728 -->
                            <div class="text-center pb-48">
                                <a href="#">
                                    <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg" alt="">
                                </a>
                            </div>

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
