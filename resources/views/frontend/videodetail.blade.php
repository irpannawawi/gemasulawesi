@extends('layouts.web')
@section('content')
    @php
        $youtubeData = getYoutubeData($video->url)->snippet;
    @endphp
    <!-- Breadcrumbs -->
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ url('/') }}" class="breadcrumbs__url"><i class="fa-solid fa-house"></i></a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('video') }}" class="breadcrumbs__url">Video</a>
            </li>
        </ul>
    </div>

    <div class="main-container container" id="main-container">
        <!-- Content -->
        <div class="row">
            <!-- post content -->
            <div class="col-lg-8 blog__content">
                <div class="meta-single-post">
                    <h1 class="title-single-post single-post__title-single-post">
                        {{ $video->title }}
                    </h1>
                    <div class="entry__meta-holder">
                        <ul class="entry__meta">
                            <li class="entry__meta-author">
                                <span>Tim Gema</span>
                            </li>
                            <li class="entry__meta-date">
                                {{ convert_date_to_ID($video->created_at) }}
                            </li>
                        </ul>
                    </div>
                    <div class="social-post socials--medium socials--rounded">
                        <a href="#" target="_blank" class="social social-facebook" id="share-facebook-top"
                            aria-label="facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" target="_blank" class="social social-twitter" id="share-twitter-top"
                            aria-label="twitter"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" target="_blank" class="social social-whatsapp" id="share-whatsapp-top"
                            aria-label="whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#" target="_blank" class="social social-telegram" id="share-telegram-top"
                            aria-label="telegram"><i class="fa-brands fa-telegram"></i></a>
                        <a href="#" class="social social-copy" id="share-copy-top" aria-label="copy"><i
                                class="fa-solid fa-link"></i></a>
                    </div>
                </div>

                <!-- Entry Image -->
                <div class="thumb videos__player image-single-post">
                    <div class="videos__ratio">
                        <iframe height="400" width="700"
                            src="https://www.youtube.com/embed/{{ getYoutubeData($video->url)->id }}"
                            title="YouTube video player"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <!-- standard post -->
                <article class="entry mb-0">
                    <div class="entry__article-wrap mt-3">
                        <div class="entry__article">
                            <article class="read__content">

                                <pre>{!! $video->description !!}</pre>

                                <div class="croslink">
                                    <a href="https://news.google.com/search?q=gemasulawesi.com&hl=id&gl=ID&ceid=ID%3Aid"
                                        target="_blank" rel="noopener noreferrer">Ikuti Update Berita Terkini Gemasulawesi
                                        di: <strong>Google News</strong></a>
                                </div>
                            </article>
                        </div> <!-- end entry article -->
                    </div> <!-- end entry article wrap -->
                </article> <!-- end standard post -->
            </div> <!-- end post content -->
            <!-- Sidebar -->
            <x-sidebar />
            <!-- end sidebar -->
        </div> <!-- end content -->
        <div class="row">
            <div class="col-lg-8 order-lg-2">
                <div class="title-post">
                    <span>Video Lainnya</span>
                </div>
                <div class="row">
                    <div class="col">
                        @foreach ($videoTerkini as $video)
                            @php
                                $currentVideoId = request()->segment(3);
                                $isCurrentVideo = $currentVideoId == $video->video_id;
                            @endphp
                            @if (!$isCurrentVideo)
                                <ul class="post-list-small post-list-small--2 mb-32 mt-3">
                                    <li class="post-list-small__item">
                                        <article class="post-list-small__entry clearfix">
                                            <div class="video__img">
                                                <a
                                                    href="{{ route('videtail', [
                                                        'video_id' => $video->video_id,
                                                        'title' => Str::slug($video->title),
                                                    ]) }}">
                                                    <i class="play__buttom fas fa-play-circle"></i>
                                                    <img data-src="{{ $youtubeData->thumbnails->medium->url }}"
                                                        src="{{ url('assets/frontend') }}/img/empty.jpg"
                                                        alt="{{ $video->title }}" class="lazyload">
                                                </a>
                                            </div>
                                            <div class="post-list-small__body">
                                                <ul class="entry__meta category underline">
                                                    <li>
                                                        <a href="{{ route('video') }}"
                                                            class="entry__meta-category">Video</a>
                                                    </li>
                                                </ul>
                                                <h3 class="post-list-small__entry-title">
                                                    <a href="{{ route('videtail', [
                                                        'video_id' => $video->video_id,
                                                        'title' => Str::slug($video->title),
                                                    ]) }}"
                                                        class="post-title">{{ $video->title }}</a>
                                                </h3>
                                                <p class="bt__date">{{ convert_date_to_ID($video->created_at) }}</p>
                                            </div>
                                        </article>
                                    </li>
                                </ul>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
