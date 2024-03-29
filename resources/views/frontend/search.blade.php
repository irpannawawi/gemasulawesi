@extends('layouts.other')
@section('content')
    <div class="main-container container" id="main-container">
        
        <!-- Content -->
        <div class="row row-20">
            
            <!-- slider -->
            <div class="col-lg-8 order-lg-2">
                <x-ad-item position='top_page'/>

                <section>
                    <!-- Pencarian -->
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <h1>Pencarian</h1>
                        </div>
                        <!-- Search form -->
                        <form class="form-inline search mt-2 mb-3" action="{{ route('search') }}">
                            <input class="form-control mr-sm-2 mb-0" name="q" type="text" value="{{ request('q') }}"
                                placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"
                                    aria-hidden="true"></i> Search</button>
                        </form>
                        @if ($beritaTerkini->count() > 0)
                            <div class="result-search">
                                <p>Hasil pencarian untuk <strong>'{{ $keyword }}'</strong></p>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <ul class="post-list-small post-list-small--2 mb-32">
                                        @foreach ($beritaTerkini[0] as $post)
                                            <li class="post-list-small__item">
                                                <article class="post-list-small__entry clearfix">
                                                    <div class="post__img">
                                                        <a
                                                            href="{{ route('singlePost', [
                                                                'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                                                'post_id' => $post->post_id,
                                                                'slug' => $post->slug,
                                                            ]) }}">
                                                            <img data-src="{{ get_post_image($post->post_id) }}"
                                                                src="{{ url('assets/frontend') }}/img/empty.jpg"
                                                                alt="{{ $post->title }}" class="lazyload">
                                                        </a>
                                                    </div>
                                                    <div class="post-list-small__body">
                                                        <ul class="entry__meta category underline">
                                                            <li>
                                                                <a href="{{ route('category', ['rubrik_name' => Str::slug($post->rubrik?->rubrik_name)]) }}"
                                                                    class="entry__meta-category">{{ $post->rubrik?->rubrik_name }}</a>
                                                            </li>
                                                        </ul>
                                                        <h3 class="post-list-small__entry-title">
                                                            <a href="{{ route('singlePost', [
                                                                'rubrik' => Str::slug($post->rubrik?->rubrik_name),
                                                                'post_id' => $post->post_id,
                                                                'slug' => $post->slug,
                                                            ]) }}"
                                                                class="">{{ $post->title }}</a>
                                                        </h3>
                                                        <p class="bt__date">{{ convert_date_to_ID($post->published_at) }}
                                                        </p>
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
                                        @if (isset($beritaTerkini[1]))
                                            @foreach ($beritaTerkini[1] as $post)
                                                <li class="post-list-small__item">
                                                    <article class="post-list-small__entry clearfix">
                                                        <div class="post__img">
                                                            <a
                                                                href="{{ route('singlePost', [
                                                                    'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                                                    'post_id' => $post->post_id,
                                                                    'slug' => $post->slug,
                                                                ]) }}">
                                                                <img data-src="{{ get_post_image($post->post_id) }}"
                                                                    src="{{ url('assets/frontend') }}/img/empty.jpg"
                                                                    alt="{{ $post->title }}" class="lazyload">
                                                            </a>
                                                        </div>
                                                        <div class="post-list-small__body">
                                                            <ul class="entry__meta category underline">
                                                                <li>
                                                                    <a href="{{ route('category', ['rubrik_name' => Str::slug($post->rubrik?->rubrik_name)]) }}"
                                                                        class="entry__meta-category">{{ $post->rubrik?->rubrik_name }}</a>
                                                                </li>
                                                            </ul>
                                                            <h3 class="post-list-small__entry-title">
                                                                <a href="{{ route('singlePost', [
                                                                    'rubrik' => Str::slug($post->rubrik?->rubrik_name),
                                                                    'post_id' => $post->post_id,
                                                                    'slug' => $post->slug,
                                                                ]) }}"
                                                                    class="">{{ $post->title }}</a>
                                                            </h3>
                                                            <p class="bt__date">
                                                                {{ convert_date_to_ID($post->published_at) }}
                                                            </p>
                                                        </div>
                                                    </article>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <!-- Ad Banner 728 -->
                                </div>
                            </div>
                            {{ $paginatedPost->onEachSide(1)->links() }}
                        @else
                            <div class="search__empty mt-3">
                                <p class="search__result">Hasil pencarian untuk <b>'{{ $keyword }}'</b> tidak
                                    Tersedia</p>
                            </div>
                        @endif
                    </div>
                </section>
                
            </div> <!-- end slider -->
            
            <!-- Sidebar -->
            <x-sidebar />
            <!-- end sidebar -->
        </div> <!-- end content -->
        <div class="col-lg-8">
            <x-ad-item position='footer' />
        </div>
    </div> <!-- end main container -->
@endsection
