<!DOCTYPE html>
<html lang="id">
@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    $breakingNews = App\Models\Breakingnews::get();
    use App\Models\Rubrik;
    use App\Models\Navigation;
@endphp

<head>
    @php

        $subTitle = get_setting('sub_title');
        if (request()->is('/')) {
            $metaTitle = get_setting('title') . ' - ' . $subTitle;
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = env('APP_CDN') . '/storage/logo/' . get_setting('logo_web');
            $type = 'website';
            $author = '';
        } elseif (request()->is('category/*')) {
            $metaTitle = 'Berita Seputar ' . $rubrik_name . ' Hari Ini' . ' - ' . $subTitle;
            $metaDeskripsi =
                'Berita ' . $rubrik_name . ' Terbaru Hari Ini, Menyajikan Berita dan Kabar Terkini ' . $rubrik_name;
            $metaImage = env('APP_CDN') . '/storage/logo/' . get_setting('logo_web');
            $type = 'website';
            $author = '';
        } elseif (request()->is('tags/*')) {
            $metaTitle = 'Berita Seputar ' . $tag_name . ' Terbaru dan Terkini Hari Ini';
            $metaDeskripsi = 'Berita ' . $tag_name . ' Terbaru dan Terkini ';
            $metaImage = env('APP_CDN') . '/storage/logo/' . get_setting('logo_web');
            $type = 'website';
            $author = '';
        } elseif (request()->is('gallery')) {
            $metaTitle = 'Gallery Berita Terkini' . ' - ' . $subTitle;
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = env('APP_CDN') . '/storage/logo/' . get_setting('logo_web');
            $type = 'website';
            $author = '';
        } elseif (request()->is('galery/detail/*')) {
            $metaTitle = $galery->galery_name . ' - ' . $subTitle;
            $metaDeskripsi = $galery->galery_description . ' - ' . $subTitle ?? '';
            $metaImage = Storage::url('galery-images/' . $galery->galery_thumbnail);
            $type = 'article';
            $author = '';
        } else {
            $postTitle = $post->title ?? '';
            $subTitle = $subTitle;
            $page = request()->query('page');
            $pageSuffix = '';
            if ($page > 1) {
                $pageSuffix = $page ? ' - Halaman ' . $page : '';
            }
            $metaTitle = $postTitle . ' - ' . $subTitle . $pageSuffix;

            $metaDeskripsi = str::limit($post->description, 140, '...') . $pageSuffix;
            $imagePath = get_post_image($post->post_id) ?? '';
            $metaImage = asset($imagePath);
            $type = 'article';
            $category = $post->rubrik->rubrik_name;
            $author = $post->author?->display_name;
            $editor = $post->editor->display_name;
            $post_id = $post->post_id;
            $editor_id = $post->editor_id;
            $author_id = $post->author_id;
            $publish = $post->published_at;
            $tagNames = [];
            if ($post->tags) {
                foreach (json_decode($post->tags) as $tagId) {
                    $tag = cache()->remember('tags' . $tagId, env('CACHE_DURATION'), function () use ($tagId) {
                        return \App\Models\Tags::find($tagId);
                    });

                    if ($tag) {
                        $tagNames[] = $tag->tag_name;
                    }
                }
            }
        }
    @endphp
    @php
        // Dapatkan URL saat ini
        $currentUrl = url()->full();

        // Periksa apakah URL memenuhi pola gemasulawesi.com/id/*
        if (strpos($currentUrl, 'gemasulawesi.com/id/') !== false) {
            // Hanya tampilkan link rel amphtml jika URL memenuhi kriteria
            $ampUrl = preg_replace('/\/(\d+)\//', '/amp/$1/', $currentUrl);
            echo '<link rel="amphtml" href="' . $ampUrl . '" data-component-name="amp:html:link">';
        }
    @endphp
    {{-- periksa apakah terdaat headline --}}
    @if (isset($headlineWp))
        @foreach ($headlineWp as $headline)
            <link rel="preload" href="{{ env('APP_CDN') . '/storage/photos/' . $headline->post->image->asset->file_name }}"
                as="image">
        @endforeach
    @endif
    {{-- check headline --}}
    <link href="//securepubads.g.doubleclick.net" rel="dns-prefetch">
    <link href="//googleads.g.doubleclick.net" rel="dns-prefetch">
    <link href="//pagead2.googlesyndication.com" rel="dns-prefetch">
    <link href="//fonts.googleapis.com" rel="dns-prefetch">
    <link href="//www.gemasulawesi.com" rel="dns-prefetch">
    <!-- s: open graph -->
    <title itemprop="name">{{ $metaTitle }}</title>
    <x-feed-links />
    <link href="{{ $metaImage }}" itemprop="image" />
    <link href="{{ Storage::url('favicon/') . get_setting('favicon') }}" rel="icon" type="image/ico" />
    <link rel="apple-touch-icon-precomposed" href="{{ Storage::url('favicon/') . get_setting('favicon') }}">
    <link rel="canonical" href="{{ url()->full() }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="title" content="{{ $metaTitle }}" />
    <meta name="description" content="{{ $metaDeskripsi }}" itemprop="description">
    <meta name="thumbnailUrl" content="{{ $metaImage }}" itemprop="thumbnazilUrl" />
    <meta name="author" content="{{ @$author }}" itemprop="author">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base" content="https://www.gemasulawesi.com/" />
    <meta name="robots" content="index,follow" />
    <meta name="googlebot-news" content="index,follow" />
    <meta name="googlebot" content="index,follow" />
    <meta name="language" content="id" />
    <meta name="geo.country" content="id" />
    <meta http-equiv="content-language" content="In-Id" />
    <meta name="geo.placename" content="Indonesia" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-language" content="In-Id" />
    <meta content="{{ url()->full() }}" itemprop="url" />
    <meta charset="utf-8">
    <meta property="og:type" content="{{ $type }}" />
    <meta property="og:url" content="{{ url()->full() }}" />
    <meta property="og:title" content="{{ $metaTitle }}" />
    <meta property="og:description" content="{{ $metaDeskripsi }}" />
    <meta property="og:site_name" content="{{ $metaTitle }}" />
    <meta property="og:image" content="{{ $metaImage }}" />
    {{-- <meta property="og:image:width" content="1200" /> Causing an error --}}
    {{-- <meta property="og:image:height" content="630" /> Causing an error --}}
    <meta property="fb:app_id" content="" />
    <meta property="fb:pages" content="" />
    <meta property="article:author" content="{{ @$author }}">
    <meta property="article:section" content="{{ @$category }}">
    <!-- e: open graph -->

    <!-- dable -->
    <meta property="dable:item_id" content="{{ @$post_id }}">
    <meta property="dable:author" content="{{ @$author }}">
    <meta property="article:section" content="{{ @$category }}">
    <meta property="article:published_time" content="{{ @$publish }}">
    <!-- end dable -->

    <!-- S:tweeter card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ '@' . get_setting('x') }}" />
    <meta name="twitter:creator" content="{{ '@' . get_setting('x') }}">
    <meta name="twitter:title" content="{{ $metaTitle }}" />
    <meta name="twitter:description" content="{{ $metaDeskripsi }}" />
    <meta name="twitter:image" content="{{ $metaImage }}" />
    <!-- E:tweeter card -->

    <meta name="content_PublishedDate" content="{{ @$publish }}" />
    <meta name="content_Category" content="{{ @$category }}" />
    <meta name="content_Author" content="{{ @$author }}" />
    <meta name="content_Editor" content="{{ @$editor }}" />
    <meta name="content_ID" content="{{ @$post_id }}" />
    <meta name="content_Type" content="Standard" />
    <meta name="content_Source" content="" />
    <meta name="content_Lipsus" content="" />
    <meta name="content_Tag" content="" />
    <meta name="content_AuthorID" content="{{ @$author_id }}" />
    <meta name="content_EditorID" content="{{ @$editor_id }}" />

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
                        "content_category": "'. $tag_name .'"
                    }];
                </script>';
            } elseif (request()->is('gallery')) {
                echo '<script>
                    dataLayer = [{
                        "breadcrumb_detail": "Section Page",
                        "content_category": "Gallery"
                    }];
                </script>';
            } elseif (request()->is('galery/detail/*')) {
                echo '<script>
                    dataLayer = [{
                        "breadcrumb_detail": "Section Page",
                        "content_category": "Gallery"
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
                    "rubrik": "All",
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
        @elseif (request()->is('galery'))
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
        @elseif (request()->is('galery/detail/*'))
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
                    "tag": {{ implode(', ', $tagNames) }},
                    "penulis_id": "All",
                    "editor_id": "All"
                }];
            </script>
        @endif

        @php
            $imagePath = get_post_image($post->post_id) ?? '';
            $image = asset($imagePath);
            $segments = request()->segments();
            $lastSegment = end($segments);
            $jsonLDData = [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => 'Gema Sulawesi',
                'url' => url()->full(),
                'logo' => asset('frontend/img/favicon.png'),
            ];
            $jsonPost = [
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'headline' => $metaTitle,
                'url' => url()->full(),
                'datePublished' => $post->published_at . ' WITA',
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
            } elseif (request()->is('galery')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('galery/detail/*')) {
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
                $imagePath = get_post_image($post->post_id) ?? '';
                $image = asset($imagePath);
                $jsonLDData = [
                    '@context' => 'https://schema.org',
                    '@type' => 'NewsArticle',
                    'mainEntityOfPage' => [
                        '@type' => 'WebPage',
                        '@id' => url()->full(),
                    ],
                    'headline' => $metaTitle,
                    'image' => [
                        '@type' => 'ImageObject',
                        'url' => $image,
                    ],
                    'datePublished' => $post->published_at . ' WITA',
                    'dateModified' => Carbon::parse($post->updated_at)->format('Y-m-d H:i:s') . ' WITA',
                    'author' => [
                        '@type' => 'Person',
                        'url' => url()->full(),
                        'name' => @$author,
                    ],
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => 'Gema Sulawesi',
                        'logo' => [
                            '@type' => 'ImageObject',
                            'url' => Storage::url('favicon/') . get_setting('favicon'),
                            'width' => 600,
                            'height' => 60,
                        ],
                    ],
                    'description' => $metaDeskripsi,
                ];
                $jsonLD = json_encode($jsonLDData, JSON_PRETTY_PRINT);
                echo '<script type="application/ld+json">' . $jsonLD. '</script>';
            }
        @endphp

        {{-- breadcrumb --}}
        @php
            $jsonLDData = [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'url' => url()->full(),
                'potentialAction' => [
                    [
                        '@type' => 'SearchAction',
                        'target' => 'https://www.gemasulawesi.com/search?q={search_term_string}',
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
            ];

            $artikel = [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'item' => [
                            '@id' => 'https://www.gemasulawesi.com',
                            'name' => 'Home',
                        ],
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'item' => [
                            '@id' => 'https://www.gemasulawesi.com/' . $post->rubrik->rubrik_name,
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
            } elseif (request()->is('galery')) {
                echo '<script type="application/ld+json">
            ' . $jsonLD . '
            </script>';
            } elseif (request()->is('galery/detail/*')) {
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

    @if (env('APP_ENV') != 'local')
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-E4E99NJFQY"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-E4E99NJFQY');
        </script>

        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7210727750015750"
            crossorigin="anonymous"></script>
    @endif

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap' rel='stylesheet'>
    <!-- Css -->
    {{-- preload assets --}}
    <link rel="preload" as="style"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="preload" as="style" href="{{ env('APP_CDN') }}/assets/frontend/css/bootstrap.min.css" />
    <link rel="preload" as="style" href="{{ env('APP_CDN') }}/assets/frontend/css/font-icons.css" />
    <link rel="preload" as="style" href="{{ env('APP_CDN') }}/assets/frontend/css/style.css" />
    <link rel="preload" as="style" href="{{ env('APP_CDN') }}/assets/frontend/css/custom.css" />
    <link rel="preload" as="style" href="{{ env('APP_CDN') }}/assets/frontend/css/colors/tosca.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ env('APP_CDN') }}/assets/frontend/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ env('APP_CDN') }}/assets/frontend/css/font-icons.css" />
    <link rel="stylesheet" href="{{ env('APP_CDN') }}/assets/frontend/css/style.css" />
    <link rel="stylesheet" href="{{ env('APP_CDN') }}/assets/frontend/css/custom.css" />
    <link rel="stylesheet" href="{{ env('APP_CDN') }}/assets/frontend/css/colors/tosca.css" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ Storage::url('favicon/') . get_setting('favicon') }}">
    <link rel="icon" href="{{ Storage::url('favicon/') . get_setting('favicon') }}" sizes="32x32" />
    <link rel="icon" href="{{ Storage::url('favicon/') . get_setting('favicon') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ Storage::url('favicon/') . get_setting('favicon') }}" />
    <meta name="msapplication-TileImage" content="{{ Storage::url('favicon/') . get_setting('favicon') }}" />

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- magnific css --}}
    <link async rel="{{ env('APP_CDN') }}/assets/frontend/css/magnific.css') }}">

    {{-- jquery --}}
    <script async src="{{ env('APP_CDN') }}/assets/frontend/js/jquery.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

</head>

<body class="home style-politics ">
    <!-- Bg Overlay -->
    <div class="content-overlay"></div>

    <x-sidenav />

    <main class="main oh" id="main">

        <x-trending />

        <x-front-end-nav />


        {{-- konten --}}
        @yield('content')

        <footer class="footer">
            <div class="container">
                <div class="footer__widgets">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="footer__logo">
                                <a target="_self" href="{{ env('APP_CDN') }}">
                                    <img class=" ls-is-cached lazyloaded"
                                        data-src="{{ env('APP_CDN') . '/storage/logo/' . get_setting('logo_web') }}"
                                        src="{{ env('APP_CDN') . '/storage/logo/' . get_setting('logo_web') }}"
                                        alt="{{ get_setting('title') }}" data-loaded="true">
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
                                @php
                                    $extras = App\Models\Setting::where('key', 'like', 'extra--%')
                                        ->orderBy('setting_id', 'asc')
                                        ->get();
                                @endphp
                                @foreach ($extras as $extra)
                                    @php
                                        $extra_key = $extra->key;
                                        $extra_label = Str::replace('-', ' ', explode('--', $extra->key)[1]);
                                        $extra_label = Str::ucfirst($extra_label);
                                    @endphp
                                    <div class="footer__item">
                                        <a href="{{ route('extra', ['id' => $extra->setting_id]) }}"
                                            class="footer__link" rel="noreferred">{{ $extra_label }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="footer__verifikasi">
                                <img class=" ls-is-cached lazyloaded"
                                    data-src="{{ env('APP_CDN') }}/assets/frontend/img/centang-biru.png"
                                    src="{{ env('APP_CDN') }}/assets/frontend/img/centang-biru.png" width="40"
                                    height="40" alt="PRMN Centang Biru" data-loaded="true">
                                <p>
                                    <b>Telah Diverifikasi Dewan Pers</b>
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

    </main> <!-- end main-wrapper -->
    <!-- jQuery Scripts -->
    <script src="{{ env('APP_CDN') }}/assets/frontend/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel2.thumbs@0.1.8/dist/owl.carousel2.thumbs.min.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/leafo/sticky-kit@v1.1.2/jquery.sticky-kit.js"></script>
    <script src="{{ env('APP_CDN') }}/assets/frontend/js/modernizr.min.js"></script>
    <script src="{{ env('APP_CDN') }}/assets/frontend/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <!-- Lazyload (must be placed in head in order to work) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.0.1/lazysizes.min.js"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
    <script async defer>
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "{{ env('FIREBASE_API_KEY') }}",
            authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
            databaseURL: "{{ env('FIREBASE_DATABASE_URL') }}",
            projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
            storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
            messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
            appId: "{{ env('FIREBASE_APP_ID') }}",
        };

        // Initialize Firebase
        msg = firebase.initializeApp(firebaseConfig);

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


        const registerServiceWorker = async () => {
            if ("serviceWorker" in navigator) {
                try {
                    const registration = await navigator.serviceWorker.register("/firebase-messaging-sw.js", {
                        scope: "/",
                    });
                    if (registration.installing) {
                        console.log("Service worker installing");
                    } else if (registration.waiting) {
                        console.log("Service worker installed");
                    } else if (registration.active) {
                        console.log("Service worker active");
                    }
                } catch (error) {
                    console.error(`Registration failed with ${error}`);
                }
            }
        };

        // …

        registerServiceWorker();
    </script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->

    <script async defer>
        function encodeURL(url) {
            return encodeURIComponent(url).replace(/:/g, '%3A').replace(/\//g, '%2F');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const articleTitle = "{{ @$post->title }}"; // Gantilah dengan judul artikel yang sesuai
            const currentURL = window.location.href;

            // Share ke Facebook (atas dan bawah)
            const facebookButtonTop = document.getElementById('share-facebook-top');
            facebookButtonTop.href =
                `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentURL)}`;
            const facebookButtonBottom = document.getElementById('share-facebook-bottom');
            facebookButtonBottom.href =
                `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentURL)}`;

            // Share ke Twitter (atas dan bawah)
            const twitterButtonTop = document.getElementById('share-twitter-top');
            twitterButtonTop.href =
                `https://twitter.com/intent/tweet?url=${encodeURIComponent(currentURL)}&text=${encodeURIComponent(articleTitle)}`;
            const twitterButtonBottom = document.getElementById('share-twitter-bottom');
            twitterButtonBottom.href =
                `https://twitter.com/intent/tweet?url=${encodeURIComponent(currentURL)}&text=${encodeURIComponent(articleTitle)}`;

            // Share ke WhatsApp (atas dan bawah)
            const whatsappButtonTop = document.getElementById('share-whatsapp-top');
            whatsappButtonTop.href =
                `https://api.whatsapp.com/send/?text=${encodeURIComponent(articleTitle + ' | ' + currentURL)}`;
            const whatsappButtonBottom = document.getElementById('share-whatsapp-bottom');
            whatsappButtonBottom.href =
                `https://api.whatsapp.com/send/?text=${encodeURIComponent(articleTitle + ' | ' + currentURL)}`;

            // Share ke Telegram (atas dan bawah)
            const telegramButtonTop = document.getElementById('share-telegram-top');
            telegramButtonTop.href =
                `https://t.me/share/url?url=${encodeURIComponent(articleTitle)}&text=${encodeURIComponent(currentURL)}`;
            const telegramButtonBottom = document.getElementById('share-telegram-bottom');
            telegramButtonBottom.href =
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
    <script>
        $(document).ready(function() {
            // toggle dropdown 
            $('.toggle-mobile-dropdown').on('click', (el) => {
                console.log(el)
            })


            $('.popup-youtube').magnificPopup({
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

            $('.zoom-gallery').magnificPopup({
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
                    duration: 300,
                    opener: function(element) {
                        return element.find('img');
                    }
                }

            });
        });
    </script>

    @stack('extra-js')
</body>

</html>
