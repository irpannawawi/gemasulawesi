@extends('layouts.other')
@section('content')
    <div class="main-container container" id="main-container">
        <!-- Content -->
        <div class="row row-20">

            <!-- slider -->
            <div class="col-lg-8 order-lg-2">
                <x-ad-item position='top_page' />

                <section>
                    {{-- Headline Topik --}}
                    @foreach ($topikKhusus as $topik)
                        <div class="thumb mb-4">
                            <article class="entry thumb--size-3 mb-0">
                                <div class="entry__img-holder thumb__img-holder"
                                    style="background-image: url('{{ Storage::url('public/topic-images/' . $topik->topic_image) }}');">
                                    {{-- Tampilan mobile --}}
                                    <h4 class="hl__b-subtitle">
                                        <a class="hl__link">Topik Khusus</a>
                                    </h4>
                                    <div class="bottom-gradient rubrik"></div>
                                    <div class="thumb-text-holder rubrik thumb-text-holder--2">
                                        <ul class="entry__meta">
                                            <li>
                                                <a
                                                    class="entry__meta-category entry__meta-category--label entry__meta-category--tosca">Topik
                                                    Khusus</a>
                                            </li>
                                        </ul>
                                        <div class="row">
                                            <h2 class="title-category ml-3">
                                                <a>{{ $topik->topic_name }}</a>
                                            </h2>
                                        </div>
                                        <ul class="entry__meta">
                                            <li class="entry__meta-comments">
                                                <a>{{ $topik->topic_description }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </article>

                            {{-- Tampilan mobile --}}
                            <article class="thumb-text-down">
                                <div class="hl__b-title">
                                    <a class="hl__link">
                                        {{ $topik->topic_name }}
                                    </a>
                                </div>
                                <ul class="entry__meta">
                                    <li class="entry__meta-comments">
                                        <a>{{ $topik->topic_description }}</a>
                                    </li>
                                </ul>
                            </article>
                        </div>
                    @endforeach
                    {{-- Headline rubrik --}}

                    <!-- Berita Terkini -->
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <span>Berita Terkini</span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="post-list-small post-list-small--2 mb-32">
                                    @if (!empty($beritaTerkini))
                                        @foreach ($beritaTerkini as $post)
                                            <li class="post-list-small__item">
                                                <article class="post-list-small__entry clearfix">
                                                    <div class="post__img">
                                                        <a
                                                            href="{{ route('singlePost', [
                                                                'rubrik' => Str::slug($post->rubrik?->rubrik_name),
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
                                                                class="post-title">{{ $post->title }}</a>
                                                        </h3>
                                                        <p class="bt__date">{{ convert_date_to_ID($post->published_at) }}
                                                        </p>
                                                    </div>
                                                </article>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                                {{ $paginatedPost->onEachSide(1)->links() }}

                            </div>
                        </div>
                    </div>
                </section>
                <x-ad-item position='below_headline' />
                
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
