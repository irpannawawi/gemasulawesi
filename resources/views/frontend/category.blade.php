@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">
        <!-- Content -->
        <div class="row row-20">
            <!-- slider -->
            <div class="col-lg-8 order-lg-2">
                <x-ad-item position='top_page' />

                <section>
                    <div class="title-list-berita">
                        <span>{{ $rubrik_name }}</span>
                    </div>
                    {{-- Headline Rubrik --}}
                    @if ($headlineRubrik->count() > 0)
                        <div class="thumb mb-4">
                            {{-- Tampilan mobile --}}
                            <article class="entry thumb--size-3 mb-0">
                                <div class="entry__img-holder thumb__img-holder"
                                    style="background-image: url('{{ get_post_image($headlineRubrik[0]->post->post_id) }}');">
                                    <h4 class="hl__b-subtitle">
                                        <a href="{{ route('category', ['rubrik_name' => Str::slug($headlineRubrik[0]->post->rubrik->rubrik_name)]) }}"
                                            class="hl__link">{{ $headlineRubrik[0]->post->rubrik->rubrik_name }}
                                        </a>
                                    </h4>
                                    <div class="bottom-gradient rubrik"></div>
                                    <div class="thumb-text-holder rubrik thumb-text-holder--2">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="{{ route('category', ['rubrik_name' => Str::slug($headlineRubrik[0]->post->rubrik->rubrik_name)]) }}"
                                                    class="entry__meta-category entry__meta-category--label entry__meta-category--tosca">{{ $headlineRubrik[0]->post->rubrik->rubrik_name }}</a>
                                            </li>
                                        </ul>
                                        <h2 class="title-category">
                                            <a
                                                href="{{ route('singlePost', [
                                                    'rubrik' => Str::slug($headlineRubrik[0]->post->rubrik->rubrik_name),
                                                    'post_id' => $headlineRubrik[0]->post->post_id,
                                                    'slug' => $headlineRubrik[0]->post->slug,
                                                ]) }}">{{ $headlineRubrik[0]->post->title }}</a>
                                        </h2>
                                        <ul class="entry__meta">
                                            <li class="entry__meta-comments">
                                                <a> {{ convert_date_to_ID($headlineRubrik[0]->published_at) }} </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                            {{-- Tampilan pc --}}
                            <article class="thumb-text-down">
                                <div class="hl__b-title">
                                    <a href="{{ route('singlePost', [
                                        'rubrik' => Str::slug($headlineRubrik[0]->post->rubrik->rubrik_name),
                                        'post_id' => $headlineRubrik[0]->post->post_id,
                                        'slug' => $headlineRubrik[0]->post->slug,
                                    ]) }}"
                                        class="hl__link">
                                        {{ $headlineRubrik[0]->post->title }}
                                    </a>
                                </div>
                                <ul class="entry__meta">
                                    <li class="entry__meta-comments">
                                        <a> {{ convert_date_to_ID($headlineRubrik[0]->publihed_at) }} </a>
                                    </li>
                                </ul>
                            </article>
                        </div>
                    @endif
                    {{-- Headline rubrik --}}
                    <x-ad-item position='below_headline' />

                    <!-- Berita Terkini -->
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <span>Berita Terkini</span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="post-list-small post-list-small--2 mb-32">
                                    @if (!empty($beritaTerkini[0]))
                                        @foreach ($beritaTerkini[0] as $post)
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
                                                        <p class="bt__date">{{ convert_date_to_ID($post->publihed_at) }}
                                                        </p>
                                                    </div>
                                                </article>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                                <!-- Ad Banner 728 -->
                                {{-- <div class="text-center pb-48">
                                    <a href="#">
                                        <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg"
                                            alt="">
                                    </a>
                                </div> --}}
                                <x-ad-item position='in_article_list' num="0" />

                                <x-topik_khusus :$topikKhusus />
                                <x-ad-item position='in_article_list' num="1" />

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
                                @if (!empty($beritaTerkini[1]))
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
                                                            class="post-title">{{ $post->title }}</a>
                                                    </h3>
                                                    <p class="bt__date">{{ convert_date_to_ID($post->publihed_at) }}</p>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>


                            <!-- Ad Banner 728 -->

                            {{ $paginatedPost->onEachSide(1)->links() }}
                        </div>
                    </div>
                </section> <!-- end carousel posts -->
            <x-ad-item position='footer' />

            </div>

        </div>
    </div> <!-- end main container -->
@endsection
