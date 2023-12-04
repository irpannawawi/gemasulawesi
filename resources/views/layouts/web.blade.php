<!DOCTYPE html>
<html lang="en">
@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    $breakingNews = App\Models\Breakingnews::get();
    use App\Models\Rubrik;

    $baseUrl = URL::to('');
@endphp

<head>
    @php
        if (request()->is('/')) {
            $metaTitle = get_setting('title');
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = asset('assets/frontend/img/cropped-LOGO-GEMAS-1-768x164.png.webp');
            $type = 'website';
        } elseif (request()->is('category/*')) {
            $metaTitle = 'Berita ' . $rubrik_name . ' Hari Ini';
            $metaDeskripsi = 'Berita ' . $rubrik_name . ' Terbaru Hari Ini, Menyajikan Berita dan Kabar Terkini ' . $rubrik_name;
            $metaImage = asset('assets/frontend/img/cropped-LOGO-GEMAS-1-768x164.png.webp');
            $type = 'website';
        } elseif (request()->is('tags/*')) {
            $metaTitle = 'Berita ' . $tag_name . ' Hari Ini';
            $metaDeskripsi = $post->description ?? '';
            $metaImage = asset('assets/frontend/img/cropped-LOGO-GEMAS-1-768x164.png.webp');
            $type = 'website';
        } elseif (request()->is('image')) {
            $metaTitle = 'Gallery Image';
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = asset('assets/frontend/img/cropped-LOGO-GEMAS-1-768x164.png.webp');
            $type = 'website';
        } elseif (request()->is('video')) {
            $metaTitle = 'Gallery Video';
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = asset('assets/frontend/img/cropped-LOGO-GEMAS-1-768x164.png.webp');
            $type = 'website';
        } elseif (request()->is('video/detail/*')) {
            $postTitle = $video->title;
            $metaTitle = $postTitle;
            $metaDeskripsi = '';
            $metaImage = '';
            $type = 'article';
        } else {
            $postTitle = $post->title;
            $metaTitle = $postTitle;
            $metaDeskripsi = $post->description;
            $imagePath = get_post_image($post->post_id) ?? '';
            $metaImage = asset($imagePath);
            $type = 'article';
            $category = $post->rubrik->rubrik_name;
            $tags = $post->tags;
        }
        $subTitle = get_setting('sub_title');
    @endphp
    <!-- s: open graph -->
    <title itemprop="name">{{ $metaTitle . ' - ' . $subTitle }}</title>
    <link href="{{ $metaImage }}" itemprop="image" />
    <link href="{{ url('assets/frontend/img') }}/cropped-favicon-32x32.png?v=892" rel="icon" type="image/ico" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('assets/frontend/img') }}/cropped-favicon-192x192.png?v=892">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="title" content="{{ $metaTitle . ' - ' . $subTitle }}" />
    <meta name="description" content="{{ $metaDeskripsi }}" itemprop="description">
    <meta name="thumbnailUrl" content="{{ $metaImage }}" itemprop="thumbnailUrl" />
    <meta name="author" content="www.Gemasulawesi.com" itemprop="author">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base" content="https://www.gemasulawesi.com/" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="index,follow" />
    <meta name="googlebot-news" content="index,follow" />
    <meta name="googlebot" content="index,follow" />
    <meta name="language" content="id" />
    <meta name="geo.country" content="id" />
    <meta name="geo.region" content="ID" />
    <meta name="geo.placename" content="Indonesia" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-language" content="In-Id" />
    <meta property="og:type" content="{{ $type }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $metaTitle . ' - ' . $subTitle }}" />
    <meta property="og:description" content="{{ $metaDeskripsi }}" />
    <meta property="og:site_name" content="www.Gemasulawesi.com" />
    <meta property="og:image" content="{{ $metaImage }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="fb:app_id" content="" />
    <meta property="fb:pages" content="" />
    <meta property="article:author" content="Tim Gema Sulawesi">
    <meta property="article:section" content="">
    <meta property="article:tag" content="">
    <meta content="{{ url()->current() }}" itemprop="url" />
    <meta charset="utf-8">
    <!-- e: open graph -->

    <!-- S:tweeter card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ get_setting('x') }}" />
    <meta name="twitter:creator" content="{{ get_setting('x') }}">
    <meta name="twitter:title" content="{{ $metaTitle . ' - ' . $subTitle }}" />
    <meta name="twitter:description" content="{{ $metaDeskripsi }}" />
    <meta name="twitter:image" content="{{ $metaImage }}" />
    <!-- E:tweeter card -->

    @if (!empty($post))
        @php
            $category = $post->rubrik->rubrik_name;
            if (request()->is('/')) {
                echo '<script>
                    dataLayer = [{
                        "breadcrumb_detail": "Homepage",
                        "content_category": ""
                    }];
                </script>';
            } elseif (request()->is('category/*')) {
                echo '<script>
                    dataLayer = [{
                        "breadcrumb_detail": "Section Page",
                        "content_category": "'. $category .'"
                    }];
                </script>';
            } elseif (request()->is('tags/*')) {
                echo '<script>
                    dataLayer = [{
                        "breadcrumb_detail": "Section Page",
                        "content_category": "Tag"
                    }];
                </script>';
            } elseif (request()->is('image')) {
                echo '<script>
                    dataLayer = [{
                        "breadcrumb_detail": "Section Page",
                        "content_category": "Image"
                    }];
                </script>';
            } elseif (request()->is('video')) {
                echo '<script>
                    dataLayer = [{
                        "breadcrumb_detail": "Section Page",
                        "content_category": "Video"
                    }];
                </script>';
            } elseif (request()->is('video/detail/*')) {
                echo '<script>
                    dataLayer = [{
                        "content_category": ""
                    }];
                </script>';
            } else {
                echo '<script>
                    dataLayer = [{
                        "breadcrumb_detail": "Article Page",
                        "content_category": "'. $category .'"
                    }];
                </script>';
            }
        @endphp

        @if (request()->is('/'))
            <script>
                dataLayer = [{
                    "published_date": "All",
                    "rubrik": "All",
                    "penulis": "All",
                    "editor": "All",
                    "id": "All",
                    "type": "All",
                    "source": "Not Available",
                    "topic": "Not Available",
                    "tag": "Berita Terkini, Berita Hari Ini, Berita Harian, Berita Terbaru, Berita, Berita Terpercaya, Berita indonesia, Berita Terpopuler, Berita, Info Jawa Barat, Info Bandung, Info Terkini, Info Hari Ini, Info Harian, Info Terbaru, Info Akurat, Info Terpercaya, Info indonesia, Info Terpopuler, Info Nasional, Gema Sulawesi, Gema",
                    "penulis_id": "All",
                    "editor_id": "All"
                }];
            </script>
        @elseif (request()->is('category/*'))
            <script>
                dataLayer = [{
                    "published_date": "All",
                    "rubrik": "All", // Ganti dengan variabel yang sesuai
                    "penulis": "All",
                    "editor": "All",
                    "id": "All",
                    "type": "All",
                    "source": "Not Available",
                    "topic": "Not Available",
                    "tag": "Berita, {{ $category }} , Terbaru, Terkini, Hari Ini",
                    "penulis_id": "All",
                    "editor_id": "All"
                }];
            </script>
        @elseif (request()->is('tags/*'))
            <script>
                dataLayer = [{
                    "published_date": "All",
                    "rubrik": "All",
                    "penulis": "All",
                    "editor": "All",
                    "id": "All",
                    "type": "All",
                    "source": "Not Available",
                    "topic": "Not Available",
                    "tag": "Berita, {{ $tag_name }} , Terbaru, Terkini, Hari Ini",
                    "penulis_id": "All",
                    "editor_id": "All"
                }];
            </script>
        @elseif (request()->is('image'))
            <script>
                dataLayer = [{
                    "published_date": "All",
                    "rubrik": "All",
                    "penulis": "All",
                    "editor": "All",
                    "id": "All",
                    "type": "All",
                    "source": "Not Available",
                    "topic": "Not Available",
                    "tag": "",
                    "penulis_id": "All",
                    "editor_id": "All"
                }];
            </script>
        @elseif (request()->is('video'))
            <script>
                dataLayer = [{
                    "published_date": "All",
                    "rubrik": "All",
                    "penulis": "All",
                    "editor": "All",
                    "id": "All",
                    "type": "All",
                    "source": "Not Available",
                    "topic": "Not Available",
                    "tag": "",
                    "penulis_id": "All",
                    "editor_id": "All"
                }];
            </script>
        @else
            <script>
                dataLayer = [{
                    "published_date": "All",
                    "rubrik": "All",
                    "penulis": "All",
                    "editor": "All",
                    "id": "All",
                    "type": "All",
                    "source": "Not Available",
                    "topic": "Not Available",
                    "tag": "{{ $post->tags }}",
                    "penulis_id": "All",
                    "editor_id": "All"
                }];
            </script>
        @endif

        @php
            preg_match('/<img src="(.*?)">/', $post->article, $matches);
            $imagePath = $matches[1] ?? '';
            $image = asset($imagePath);
            $segments = request()->segments();
            $lastSegment = end($segments);
            $postTitle = str_replace('-', ' ', $lastSegment);
            $jsonLDData = [
                '@context' => 'http://schema.org/',
                '@type' => 'Organization',
                'name' => 'www.gemasulawesi.com',
                'url' => 'https://www.gemasulawesi.com',
                'logo' => asset('frontend/img/favicon.png'),
                'potentialAction' => [['https://web.facebook.com/gemasulawesi', 'https://instagram.com/gema.parimo', 'https://twitter.com/gemasulawesi']],
            ];
            $jsonPost = [
                '@context' => 'http://schema.org/',
                '@type' => 'WebPage',
                'headline' => $postTitle,
                'url' => url()->current(),
                'datePublished' => $post->created_at,
                'image' => $image,
                'thumbnailUrl' => $image,
            ];

            $jsonLD = json_encode($jsonLDData, JSON_PRETTY_PRINT);
            $jsonP = json_encode($jsonPost, JSON_PRETTY_PRINT);
            if (request()->is('/*')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('category/*')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('tags/*')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('image')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('video')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('video/detail/*')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } else {
                echo '<script type="application/ld+json">
            ' . $jsonP . '
            </script>';
            }
        @endphp

        @php
            $excludedUrls = ['search/', 'indeks-berita/', 'topik-khusus/detail/*', 'tentang-kami', 'kode-etik'];

            $shouldDisplayJsonLD = true;
            foreach ($excludedUrls as $url) {
                if (str_contains(request()->url(), $url)) {
                    $shouldDisplayJsonLD = false;
                    break;
                }
            }

            if ($shouldDisplayJsonLD) {
                preg_match('/<img src="(.*?)">/', $post->article, $matches);
                $imagePath = $matches[1] ?? ''; // Jika tidak ada gambar, setel ke string kosong
                $image = asset($imagePath);
                $segments = request()->segments();
                $lastSegment = end($segments);
                $postTitle = Str::slug('-', ' ', $lastSegment);
                $jsonLDData = [
                    '@context' => 'http://schema.org/',
                    '@type' => 'NewsArticle',
                    'mainEntityOfPage' => [
                        '@type' => 'WebPage',
                        '@id' => url()->current(),
                        'description' => $post->description,
                    ],
                    'headline' => $postTitle,
                    'image' => [
                        '@type' => 'ImageObject',
                        'url' => $image,
                    ],
                    'author' => [
                        '@type' => 'Person',
                        'name' => $post->editor->display_name,
                    ],
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => 'www.gemasulawesi.com',
                        'logo' => [
                            '@type' => 'ImageObject',
                            'url' => asset('frontend/img/favcion.png'),
                        ],
                    ],
                    'headline' => $postTitle,
                    'image' => $image,
                    'datePublished' => $post->created_at,
                    'dateModified' => $post->updated_at,
                ];
                $jsonLD = json_encode($jsonLDData, JSON_PRETTY_PRINT);
                echo '<script type="application/ld+json">
                    ' . $jsonLD. '
                </script>';
            }
        @endphp

        {{-- breadcrumb --}}
        @php
            $jsonLDData = [
                '@context' => 'http://schema.org/',
                '@type' => 'WebSite',
                'url' => url()->current(),
                'potentialAction' => [
                    [
                        '@type' => 'SearchAction',
                        'target' => url()->current(),
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
            ];

            $artikel = [
                '@context' => 'http://schema.org/',
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'item' => [
                            '@id' => url()->current(),
                            'name' => 'Home',
                        ],
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'item' => [
                            '@id' => url()->current(),
                            'name' => $post->rubrik->rubrik_name,
                        ],
                    ],
                ],
            ];

            $jsonLD = json_encode($jsonLDData, JSON_PRETTY_PRINT);
            $artikelLDData = json_encode($artikel, JSON_PRETTY_PRINT);

            if (request()->is('/*')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('tags/*')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('category/*')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('image')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('video') && !request()->is('video/detail/*')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } else {
                echo '<script type="application/ld+json">
            ' . $artikelLDData . '
            </script>';
            }
        @endphp
    @endif

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet'>
    <!-- Css -->
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/font-icons.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/style.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/custom.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/colors/tosca.css" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ url('assets/frontend') }}/img/favicon.png">
    <link rel="icon" href="https://www.gemasulawesi.com/wp-content/uploads/2021/07/cropped-favicon-32x32.png"
        sizes="32x32" />
    <link rel="icon" href="https://www.gemasulawesi.com/wp-content/uploads/2021/07/cropped-favicon-192x192.png"
        sizes="192x192" />
    <link rel="apple-touch-icon"
        href="https://www.gemasulawesi.com/wp-content/uploads/2021/07/cropped-favicon-180x180.png" />
    <meta name="msapplication-TileImage"
        content="https://www.gemasulawesi.com/wp-content/uploads/2021/07/cropped-favicon-270x270.png" />

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Lazyload (must be placed in head in order to work) -->
    <script src="{{ url('assets/frontend') }}/js/lazysizes.min.js"></script>
</head>

<body class="home style-politics ">
    <!-- Bg Overlay -->
    <div class="content-overlay"></div>

    <!-- Sidenav -->
    <header class="sidenav" id="sidenav">

        <!-- close -->
        <div class="sidenav__close">
            <button class="sidenav__close-button" id="sidenav__close-button" aria-label="close sidenav">
                <i class="ui-close sidenav__close-icon"></i>
            </button>
        </div>

        <!-- Nav -->
        <nav class="sidenav__menu-container">
            @php
                $rubriks = Rubrik::get();
            @endphp
            <ul class="sidenav__menu" role="menubar">
                <!-- Categories -->
                @foreach ($rubriks as $rubrik)
                    <li>
                        <a href="{{ route('category', ['rubrik_name' => $rubrik->rubrik_name]) }}"
                            class="sidenav__menu-url">{{ $rubrik->rubrik_name }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="socials sidenav__socials">
            <a class="social social-facebook" href="https://{{ get_setting('facebook') }}" target="_blank"
                aria-label="facebook">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a class="social social-twitter" href="https://{{ get_setting('x') }}" target="_blank"
                aria-label="twitter">
                <i class="fa-brands fa-square-x-twitter"></i>
            </a>
            <a class="social social-youtube" href="https:/{{ get_setting('youtube') }}" target="_blank"
                aria-label="youtube">
                <i class="fa-brands fa-youtube"></i>
            </a>
            <a class="social social-instagram" href="https://{{ get_setting('instagram') }}" target="_blank"
                aria-label="instagram">
                <i class="fa-brands fa-square-instagram"></i>
            </a>
        </div>
    </header> <!-- end sidenav -->

    <main class="main oh" id="main">

        <!-- Trending Now -->
        @if ($breakingNews->count() > 0)
            <div class="kontiner">
                <div class="trending-now trending-now--1">
                    <span class="trending-now__label">
                        <i class="ui-flash"></i>
                        <span class="trending-now__text d-lg-inline-block d-none">Breaking News</span>
                    </span>
                    <div class="newsticker">
                        <ul class="newsticker__list">
                            @foreach ($breakingNews as $news)
                                <li class="newsticker__item">
                                    <i class="fa-solid fa-newspaper"></i>
                                    <a href="{{ route('singlePost', [
                                        'rubrik' => $news->post->rubrik->rubrik_name,
                                        'post_id' => $news->post->post_id,
                                        'slug' => $news->post->slug,
                                    ]) }}"
                                        class="newsticker__item-url">{{ $news->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        @endif

        <!-- Header -->
        <header class="header d-lg-block d-none">
            <div class="container">
                <div class="flex-parent">

                    <!-- Date -->
                    <nav class="flex-child header__menu d-none d-lg-block">
                        <ul class="header__menu-list">
                            <li><a>{{ Carbon::now()->locale('id_ID')->isoFormat('dddd, DD MMMM YYYY') }}</a></li>
                        </ul>
                    </nav>

                    <!-- end date -->

                    <div class="flex-child text-center mt-3 mb-3">
                        <!-- Logo -->
                        <a href="{{ url('') }}" class="logo">
                            <img class="logo__img"
                                src="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-2048x437.png.webp"
                                srcset="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-2048x437.png.webp 1x, img/cropped-LOGO-GEMAS-1-2048x437.png.webp"
                                alt="logo" width="280" height="280">
                        </a>
                    </div>

                    <!-- Socials -->
                    <div class="flex-child">
                        <div class="d-flex align-items-center" style="gap: 20px;position: relative;">
                            <div class="nav__right-item nav__search">
                                <a href="javascript:;" class="nav__search-trigger nav__search-trigger-lg">
                                    <i class="ui-search nav__search-trigger-icon"></i>
                                </a>
                                <div class="nav__search-box" style="right: 0%;z-index: 121;">
                                    <form class="nav__search-form" action="{{ route('search') }}">
                                        <input type="text" name="q" placeholder="Search..."
                                            class="nav__search-input" value="{{ request('q') }}">
                                        <button type="submit" class="search-button btn btn-lg btn-color btn-button">
                                            <i class="ui-search "></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="socials socials--nobase socials--nav socials--dark justify-content-end">
                                <a class="social social-facebook" href="https://{{ get_setting('facebook') }}"
                                    target="_blank" aria-label="facebook">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                <a class="social social-twitter" href="https://{{ get_setting('instagram') }}"
                                    target="_blank" aria-label="twitter">
                                    <i class="fa-brands fa-square-x-twitter"></i>
                                </a>
                                <a class="social social-youtube" href="https://{{ get_setting('youtube') }}"
                                    target="_blank" aria-label="youtube">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                                <a class="social social-instagram" href="https://{{ get_setting('instagram') }}"
                                    target="_blank" aria-label="instagram">
                                    <i class="fa-brands fa-square-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- end container -->
        </header> <!-- end header -->

        <!-- Navigation -->
        <header class="nav nav--colored mb-3" id="scroll">
            <div class="nav__holder nav--sticky">
                <div class="container relative">
                    <div class="flex-parent">
                        <div class="flex-parent">
                            <div class="nav__home">
                                <a href="{{ url('/') }}" title="Home">
                                    <i class="icon fa fa-home"></i>
                                </a>
                            </div>
                            <!-- Side Menu Button -->
                            <button class="nav-icon-toggle" id="nav-icon-toggle" aria-label="Open side menu">
                                <span class="nav-icon-toggle__box">
                                    <span class="nav-icon-toggle__inner"></span>
                                </span>
                            </button>
                        </div>
                        <!-- Nav-wrap -->
                        <nav class="flex-child d-none d-lg-block">
                            <ul class="nav__menu">
                                @foreach ($rubriks->take(get_setting('count_rubrik')) as $rubrik)
                                    <li>
                                        <a href="{{ route('category', ['rubrik_name' => $rubrik->rubrik_name]) }}"
                                            class="link-nav__menu"
                                            style="white-space: nowrap;">{{ $rubrik->rubrik_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- end menu -->
                        </nav>

                        <!-- Logo Mobile -->
                        <a href="{{ url('') }}" class="logo logo-mobile d-lg-none">
                            <img class="logo__img"
                                src="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp"
                                srcset="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp 1x, {{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp 2x"
                                alt="logo">
                        </a>
                        <!-- Nav Right -->
                        <div class="flex-child">
                            <div class="nav__right">
                                <!-- lainnya -->
                                <div class="nav__right-item nav__lainnya d-none d-lg-block">
                                    <ul class="nav__menu menu__lainnya">
                                        <li class="dropdown__rubrik">
                                            <a href="javascript:;">
                                                <i class="subicon ui-arrow-down"></i>
                                            </a>
                                            <ul class="submenu">
                                                <li>
                                                    <a href="{{ route('video') }}" class="link-submenu"
                                                        style="white-space: nowrap;">Video</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('image') }}" class="link-submenu"
                                                        style="white-space: nowrap;">Image</a>
                                                </li>
                                                @foreach ($rubriks->slice(7) as $rubrik)
                                                    <li>
                                                        <a href="{{ route('category', ['rubrik_name' => $rubrik->rubrik_name]) }}"
                                                            class="link-submenu"
                                                            style="white-space: nowrap;">{{ $rubrik->rubrik_name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Search -->
                                <div class="nav__right-item nav__search d-block d-lg-none">
                                    <a href="javascript:;" class="nav__search-trigger">
                                        <i class="ui-search nav__search-trigger-icon"></i>
                                    </a>
                                    <div class="nav__search-box">
                                        <form class="nav__search-form" action="{{ route('search') }}">
                                            <input type="text" name="q" placeholder="Search..."
                                                class="nav__search-input" value="{{ request('q') }}">
                                            <button type="submit"
                                                class="search-button btn btn-lg btn-color btn-button">
                                                <i class="ui-search "></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end nav right -->

                        </div>
                    </div> <!-- end flex-parent -->

                </div>
            </div>

            {{-- nav mobile --}}
            <div class="py-2 category_under_nav d-sm-none">
                <div class="container">
                    <ul class="d-flex" style="gap: 20px;">
                        <!-- Categories -->
                        @foreach ($rubriks as $rubrik)
                            <li>
                                <a href="{{ route('category', ['rubrik_name' => $rubrik->rubrik_name]) }}"
                                    style="white-space: nowrap;">{{ $rubrik->rubrik_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </header> <!-- end navigation -->

        <!-- Ad Banner 728 -->
        <div class="container">
            <div class="text-center ads__banner">
                <a href="#">
                    <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg" alt="">
                </a>
            </div>
        </div>

        {{-- konten --}}
        @yield('content')

        <footer class="footer">
            <div class="container">
                <div class="footer__widgets">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="footer__logo">
                                <a target="_self" href="https://zonasurabayaraya.pikiran-rakyat.com/">
                                    <img class=" ls-is-cached lazyloaded"
                                        data-src="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp?v=907"
                                        src="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp?v=907"
                                        alt="Zona Surabaya Raya" data-loaded="true">
                                </a>
                            </div>
                            <div class="footer__contact">
                                <p>{{ get_setting('alamat') }}<br>
                                </p>
                                <p>
                                    Email: {{ get_setting('email') }}<br>
                                    Phone: {{ get_setting('no_hp') }}
                                </p>
                            </div>
                            <div class="social__footer socials--medium socials--rounded">
                                <a class="social social-facebook" href="https://{{ get_setting('facebook') }}"
                                    target="_blank" aria-label="facebook">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                <a class="social social-twitter" href="https://{{ get_setting('x') }}"
                                    target="_blank" aria-label="twitter">
                                    <i class="fa-brands fa-square-x-twitter"></i>
                                </a>
                                <a class="social social-youtube" href="https://{{ get_setting('youtube') }}"
                                    target="_blank" aria-label="youtube">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                                <a class="social social-instagram" href="https://{{ get_setting('instagram') }}"
                                    target="_blank" aria-label="instagram">
                                    <i class="fa-brands fa-square-instagram"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer__menu">
                                <div class="footer__item">
                                    <a href="{{ route('tentangkami.index') }}" class="footer__link"
                                        rel="noreferred">Tentang Kami</a>
                                </div>
                                <div class="footer__item">
                                    <a href="{{ route('kodeetik.index') }}" class="footer__link"
                                        rel="noreferred">Kode Etik</a>
                                </div>
                                <div class="footer__item">
                                    <a href="{{ route('redaksi.index') }}" class="footer__link"
                                        rel="noreferred">Redaksi</a>
                                </div>
                                <div class="footer__item">
                                    <a href="{{ route('kodepers.index') }}" class="footer__link"
                                        rel="noreferred">Kode Perilaku
                                        Pers</a>
                                </div>
                                <div class="footer__item">
                                    <a href="{{ route('pedoman.index') }}" class="footer__link"
                                        rel="noreferred">Pedoman Media
                                        Siber</a>
                                </div>
                                <div class="footer__item">
                                    <a href="{{ route('perlindungan.index') }}" class="footer__link"
                                        rel="noreferred">Perlindungan Data
                                        Pengguna</a>
                                </div>
                                <div class="footer__item">
                                    <a href="{{ route('lowongan.index') }}" class="footer__link"
                                        rel="noreferred">Lowongan Kerja</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="footer__verifikasi">
                                <img class=" ls-is-cached lazyloaded"
                                    data-src="{{ url('assets/frontend') }}/img/centang-biru.png"
                                    src="{{ url('assets/frontend') }}/img/centang-biru.png" width="40"
                                    height="40" alt="PRMN Centang Biru" data-loaded="true">
                                <p>
                                    <b>Telah di Verifikasi Dewan Pers</b>
                                    <br>
                                    <b>Sertifikat Nomor <i>{{ get_setting('no_sertification') }}</i></b>
                                </p>
                            </div>
                        </div>
                        <div class="footer__copyright col-lg-12 col-md-6">
                            <p>©{{ now()->year }} Gema Sulawesi</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        {{-- <div id="back-to-top">
            <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
        </div> --}}

    </main> <!-- end main-wrapper -->
    <!-- jQuery Scripts -->
    <script src="{{ url('assets/frontend') }}/js/jquery.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/easing.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/owl-carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel2.thumbs@0.1.8/dist/owl.carousel2.thumbs.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/flickity.pkgd.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/twitterFetcher_min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/jquery.sticky-kit.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/jquery.newsTicker.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/modernizr.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/scripts.js"></script>


    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
    <script>
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyB3UbArxJvs-eDcnq-dG5vk438-1kcx4jI",
            authDomain: "notif-29ba1.firebaseapp.com",
            databaseURL: "https://notif-29ba1.firebaseio.com",
            projectId: "notif-29ba1",
            storageBucket: "notif-29ba1.appspot.com",
            messagingSenderId: "528841843805",
            appId: "1:528841843805:web:b6a4adfc2bfb3b5765d9b4",
            measurementId: "G-XD29THY8S3"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging.requestPermission().then(function() {
                return messaging.getToken();
            }).then(function(token) {

                let url = "{{ route('subscribe') }}";
                let data = {
                    _method: "PATCH",
                    token: token,
                    _token: "{{ csrf_token() }}"
                };

                $.post(url, data, function(data) {
                    console.log(data);
                });

            }).catch(function(err) {
                console.log(`Token Error :: ${err}`);
            });
        }

        initFirebaseMessagingRegistration();

        messaging.onMessage(function(payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    </script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    @php
        $segments = request()->segments();
        $lastSegment = end($segments);
        $postTitle = str_replace('-', ' ', $lastSegment);
    @endphp
    <script>
        function encodeURL(url) {
            return encodeURIComponent(url).replace(/:/g, '%3A').replace(/\//g, '%2F');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const articleTitle = "{{ $postTitle }}"; // Gantilah dengan judul artikel yang sesuai
            const currentURL = window.location.href;

            // Share ke Facebook (atas dan bawah)
            const facebookButtonTop = document.getElementById('share-facebook-top');
            facebookButtonTop.href =
                `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentURL)}`;

            // Share ke Twitter (atas dan bawah)
            const twitterButtonTop = document.getElementById('share-twitter-top');
            twitterButtonTop.href =
                `https://twitter.com/intent/tweet?url=${encodeURIComponent(currentURL)}&text=${encodeURIComponent(articleTitle)}`;

            // Share ke WhatsApp (atas dan bawah)
            const whatsappButtonTop = document.getElementById('share-whatsapp-top');
            whatsappButtonTop.href =
                `https://api.whatsapp.com/send/?text=${encodeURIComponent(articleTitle + ' | ' + currentURL)}`;

            // Share ke Telegram (atas dan bawah)
            const telegramButtonTop = document.getElementById('share-telegram-top');
            telegramButtonTop.href =
                `https://t.me/share/url?url=${encodeURIComponent(articleTitle)}&text=${encodeURIComponent(currentURL)}`;

            // Copy ke Clipboard (atas dan bawah)
            const copyButtonTop = document.getElementById('share-copy-top');
            copyButtonTop.addEventListener('click', function(event) {
                event.preventDefault();

                const copyText = `${articleTitle} | ${currentURL}`;
                const textArea = document.createElement('textarea');
                textArea.value = copyText;

                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                alert('Artikel Berhasil disalin!');
            });

            const copyButtonBottom = document.getElementById('share-copy-bottom');
            copyButtonBottom.addEventListener('click', function(event) {
                event.preventDefault();

                const copyText = `${articleTitle} | ${currentURL}`;
                const textArea = document.createElement('textarea');
                textArea.value = copyText;

                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                alert('Artikel Berhasil disalin!');
            });
        });
    </script>

</body>

</html>
