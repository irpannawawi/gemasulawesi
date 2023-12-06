@extends('layouts.web')
@section('content')
    <!-- Breadcrumbs -->
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ url('/') }}" class="breadcrumbs__url"><i class="fa-solid fa-house"></i></a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('gallery') }}" class="breadcrumbs__url">Gallery</a>
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
                        {{ $galery->galery_name }}
                    </h1>
                    <div class="entry__meta-holder">
                        <ul class="entry__meta">
                            <li class="entry__meta-author">
                                <span>Tim Gema</span>
                            </li>
                            <li class="entry__meta-date">
                                {{ convert_date_to_ID($galery->created_at) }}
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
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($collections as $collect)
                                @if ($collect->type == 'image')
                                    <div class="carousel-item active popup-gallery">
                                        <a href="{{ url('storage/photos/' . $collect->photo->asset->file_name) }}"
                                            class="gallery__item">
                                            <img class="d-block w-100"
                                                src="{{ url('storage/photos/' . $collect->photo->asset->file_name) }}"
                                                title="{{ $collect->photo->caption }}">
                                        </a>
                                    </div>
                                @else
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="#" alt="First slide">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <!-- standard post -->
                <article class="entry mb-0">
                    <div class="entry__article-wrap mt-3">
                        <div class="entry__article">
                            <article class="read__content">

                                {!! $galery->galery_description !!}

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
                    <span>Gallery Lainnya</span>
                </div>
                <div class="row">
                    <div class="col">
                        @foreach ($galeryTerkini as $gallery)
                            @php
                                $currentGalleryId = request()->segment(3);
                                $isCurrentGallery = $currentGalleryId == $gallery->galery_id;
                            @endphp
                            @if (!$isCurrentGallery)
                                <ul class="post-list-small post-list-small--2 mb-32 mt-3">
                                    <li class="post-list-small__item">
                                        <article class="post-list-small__entry clearfix">
                                            <div class="post__img">
                                                <a
                                                    href="{{ route('galerydetail', [
                                                        'galery_id' => $gallery->galery_id,
                                                        'galery_name' => Str::slug($gallery->galery_name),
                                                    ]) }}">
                                                    {{-- <i class="play__buttom fas fa-play-circle"></i> --}}
                                                    <img data-src="{{ Storage::url('public/galery-images/') . $galery->galery_thumbnail }}"
                                                        src="{{ url('assets/frontend') }}/img/empty.jpg"
                                                        alt="{{ $gallery->galery_name }}" class="lazyload">
                                                </a>
                                            </div>
                                            <div class="post-list-small__body">
                                                <ul class="entry__meta category underline">
                                                    <li>
                                                        <a href="{{ route('gallery') }}"
                                                            class="entry__meta-category">Gallery</a>
                                                    </li>
                                                </ul>
                                                <h3 class="post-list-small__entry-title">
                                                    <a href="{{ route('galerydetail', [
                                                        'galery_id' => $gallery->galery_id,
                                                        'galery_name' => Str::slug($gallery->galery_name),
                                                    ]) }}"
                                                        class="post-title">{{ $gallery->galery_name }}</a>
                                                </h3>
                                                <p class="bt__date">{{ convert_date_to_ID($gallery->created_at) }}</p>
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
    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    gallery: {
                        enabled: true
                    },

                    fixedContentPos: false
                });
            });

            $(document).ready(function() {
                $('.popup-gallery').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: false,
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    image: {
                        verticalFit: true
                    },
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300, // don't foget to change the duration also in CSS
                        opener: function(element) {
                            return element.find('img');
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
