@extends('layouts.web')
@section('content')
    @php
        $youtubeData = getYoutubeData($videoTerkini->url)->snippet;
    @endphp
    <div class="main-container container" id="main-container">
        <!-- Content -->
        <section>
            <div class="title-list-berita">
                <span>Berita Video</span>
            </div>
            {{-- Headline Rubrik --}}
            <div class="thumb mb-4">
                {{-- Tampilan mobile --}}
                <article class="entry thumb--size-3 mb-0 thumbnail__headline">
                    <a
                        href="{{ route('videtail', [
                            'video_id' => $videoTerkini->video_id,
                            'title' => Str::slug($videoTerkini->title),
                        ]) }}">
                        <div class="entry__img-holder thumb__img-holder"
                            style="background-image: url('{{ $youtubeData->thumbnails->medium->url }}');">
                            <i class="play fas fa-play-circle"></i>
                            <div class="bottom-gradient rubrik"></div>
                            <div class="thumb-text-holder rubrik thumb-text-holder--2">
                                <h2 class="title-category">
                                    <a
                                        href="{{ route('videtail', [
                                            'video_id' => $videoTerkini->video_id,
                                            'title' => Str::slug($videoTerkini->title),
                                        ]) }}">{{ $videoTerkini->title }}</a>
                                </h2>
                            </div>
                        </div>
                    </a>
                </article>
                {{-- Tampilan pc --}}
                <article class="thumb-text-down">
                    <div class="hl__b-title">
                        <a href="{{ route('videtail', [
                            'video_id' => $videoTerkini->video_id,
                            'title' => Str::slug($videoTerkini->title),
                        ]) }}"
                            class="hl__link">{{ $videoTerkini->title }}</a>
                    </div>
                </article>
            </div>
        </section>

        <div class="row row-20">
            <div class="col-lg-8 order-lg-2">
                <!-- Berita Terkini -->
                <div class="berita-terkini">
                    <div class="title-list-berita">
                        <span>Berita Video Terkini</span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <ul class="post-list-small post-list-small--2 mb-32">
                                @foreach ($videoLainnya as $video)
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
                                @endforeach
                            </ul>
                            {{ $paginateVideo->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <x-sidebar />
        </div>
        <!-- end content -->
    </div> <!-- end main container -->
@endsection
