<!DOCTYPE html>
<html lang="en">
@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    $breakingNews = App\Models\Breakingnews::get();
    use App\Models\Rubrik;
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="canonical" href="https://www.gemasulawesi.com" />

    <meta name="robots" content="index,follow" />
    <meta name="googlebot-news" content="index,follow" />
    <meta name="googlebot" content="index,follow" />
    <meta name="language" content="id" />
    <meta name="geo.country" content="id" />
    <meta http-equiv="content-language" content="In-Id" />
    <meta name="geo.placename" content="Indonesia" />
    <!-- s: fb meta -->
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://www.gemasulawesi.com" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:site_name" content="" />
    <meta property="fb:app_id" content="" />
    <meta property="fb:pages" content="" />
    <!-- e: fb meta -->

    <!-- S:tweeter card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@promedia" />
    <meta name="twitter:creator" content="@promedia">
    <meta name="twitter:title" content="Teras Info - Bijak Bernarasi" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />
    <!-- E:tweeter card -->

    <meta name="content_PublishedDate" content="" />
    <meta name="content_Category" content="" />
    <meta name="content_Author" content="" />
    <meta name="content_Editor" content="" />
    <meta name="content_ID" content="" />
    <meta name="content_Type" content="" />
    <meta name="content_Source" content="" />
    <meta name="content_Lipsus" content="" />
    <meta name="content_Tag" content="" />
    <meta name="content_AuthorID" content="" />
    <meta name="content_EditorID" content="" />

    <title>gemasulawesi.com Berita Terkini Indonesia Hari Ini</title>

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
            <a class="social social-facebook" href="#" target="_blank" aria-label="facebook">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a class="social social-twitter" href="#" target="_blank" aria-label="twitter">
                <i class="fa-brands fa-square-x-twitter"></i>
            </a>
            <a class="social social-youtube" href="#" target="_blank" aria-label="youtube">
                <i class="fa-brands fa-youtube"></i>
            </a>
            <a class="social social-instagram" href="#" target="_blank" aria-label="instagram">
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
                                <li class="newsticker__item"><a
                                        href="{{ route('singlePost', [
                                            'rubrik' => $news->post->rubrik->rubrik_name,
                                            'post_id' => $news->post->post_id,
                                            'slug' => $news->post->slug,
                                        ]) }}"
                                        class="newsticker__item-url">{{ $news->title }}</a></li>
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
                        <div class="socials socials--nobase socials--nav socials--dark justify-content-end">
                            <a class="social social-facebook" href="#" target="_blank" aria-label="facebook">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a class="social social-twitter" href="#" target="_blank" aria-label="twitter">
                                <i class="fa-brands fa-square-x-twitter"></i>
                            </a>
                            <a class="social social-youtube" href="#" target="_blank" aria-label="youtube">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                            <a class="social social-instagram" href="#" target="_blank"
                                aria-label="instagram">
                                <i class="fa-brands fa-square-instagram"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div> <!-- end container -->
        </header> <!-- end header -->

        <!-- Navigation -->
        <header class="nav nav--colored mb-3">
            <div class="nav__holder nav--sticky">
                <div class="container relative">
                    <div class="flex-parent mb-5">

                        <div class="flex-child">
                            <!-- Side Menu Button -->
                            <div class="nav__home">
                                <a href="{{ url('/') }}" title="Home">
                                    <i class="icon fa fa-home"></i>
                                </a>
                            </div>

                            <button class="nav-icon-toggle" id="nav-icon-toggle" aria-label="Open side menu">
                                <span class="nav-icon-toggle__box">
                                    <span class="nav-icon-toggle__inner"></span>
                                </span>
                            </button>
                        </div>

                        <!-- Nav-wrap -->
                        <nav class="flex-child nav__wrap d-none d-lg-block">
                            <ul class="nav__menu">
                                @foreach ($rubriks as $rubrik)
                                    <li>
                                        <a href="{{ route('category', ['rubrik_name' => $rubrik->rubrik_name]) }}"
                                            class="link-nav__menu"
                                            style="white-space: nowrap;">{{ $rubrik->rubrik_name }}</a>
                                    </li>
                                @endforeach

                            </ul> <!-- end menu -->
                        </nav> <!-- end nav-wrap -->

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

                                <!-- Search -->
                                <div class="nav__right-item nav__search">
                                    <a href="javascript:;" class="nav__search-trigger">
                                        <i class="ui-search nav__search-trigger-icon"></i>
                                    </a>
                                    <div class="nav__search-box">
                                        <form class="nav__search-form">
                                            <input type="text" name="search" placeholder="Search an article"
                                                class="nav__search-input">
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
            <div class="py-2 mt-2 category_under_nav d-sm-none">
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
            <div class="text-center pb-48">
                <a href="#">
                    <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg" alt="">
                </a>
            </div>
        </div>

        {{-- konten --}}
        @yield('content')

        <!-- Footer -->
        <footer class="footer footer--grey">
            <div class="container">
                <div class="footer__widgets">
                    <div class="row">

                        <div class="col-lg-3 col-md-6">
                            <aside class="widget widget-logo">
                                <a href="index.html">
                                    <img src="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp"
                                        srcset="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp 1x, {{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp 2x"
                                        class="logo__img" alt="">
                                </a>
                                <p>Jl Kampali, Kelurahan Kampal Kecamatan Parigi
                                    Kabupaten Parigi moutong Provinsi Sulawesi tengah.</p>
                                <p class="copyright">
                                    &copy;
                                    <script>
                                        document.querySelector(".copyright").innerHTML += new Date().getFullYear();
                                    </script> Gema Sulawesi
                                </p>
                                <div class="socials socials--medium socials--rounded">
                                    <a href="#" class="social social-facebook" aria-label="facebook"><i
                                            class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#" class="social social-twitter" aria-label="twitter"><i
                                            class="fa-brands fa-x-twitter"></i></a>
                                    <a href="#" class="social social-youtube" aria-label="youtube"><i
                                            class="fa-brands fa-youtube"></i></a>
                                    <a href="#" class="social social-instagram" aria-label="instagram"><i
                                            class="ui-instagram"></i></a>
                                    <a href="#" class="social social-telegram" aria-label="instagram"><i
                                            class="fa-brands fa-telegram"></i></a>
                                </div>
                            </aside>
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <aside class="widget widget_nav_menu">
                                {{-- <h4 class="widget-title">Useful Links</h4> --}}
                                <div class="footer__wrap">
                                    @foreach ($rubriks as $rubrik)
                                        <ul>
                                            <li><a
                                                    href="{{ route('category', ['rubrik_name' => $rubrik->rubrik_name]) }}">{{ $rubrik->rubrik_name }}</a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </aside>
                        </div>

                    </div>
                </div>
            </div> <!-- end container -->
        </footer> <!-- end footer -->
        {{-- <footer class="footer">
            <div class="row container">
                <div class="col-offset-fluid">
                    <div class="col-bs10-4">
                        <div class="footer__logo">
                            <a href="{{ url('/') }}"><img height="240" width="240"
                                    src="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp"
                                    srcset="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp 1x, {{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp 2x"
                                    alt=""></a>
                        </div>
                        <div class="footer__contact">
                            <p>Jl Kampali, Kelurahan Kampal Kecamatan Parigi<br>Kabupaten Parigi moutong Provinsi
                                Sulawesi tengah. <br><br> 081342184833 <br> email@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-bs10-6">
                        <div class="col-offset-fluid">
                            <div class="col-bs10-3">
                                <div class="footer__menu">
                                    @php
                                        $rubriks = \App\Models\Rubrik::get();
                                    @endphp
                                    <div class="footer__item">
                                        @foreach ($rubriks as $rubrik)
                                            <a href="{{ route('category', ['rubrik_name' => $rubrik->rubrik_name]) }}"
                                                class="footer__link">{{ $rubrik->rubrik_name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer> --}}

        <div id="back-to-top">
            <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
        </div>

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

    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->

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

        //   // Initialize Firebase
        //   const app = initializeApp(firebaseConfig);
        //   const analytics = getAnalytics(app);

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging.requestPermission().then(function() {
                return messaging.getToken()
            }).then(function(token) {

                let url = "{{ route('subscribe') }}";
                let data = {
                    _method: "PATCH",
                    token: token,
                    _token: "{{csrf_token()}}"
                }

                $.post(url, data, function(data) {
                    console.log(data)
                })

            }).catch(function(err) {
                console.log(`Token Error :: ${err}`);
            });
        }

        initFirebaseMessagingRegistration();


        messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
    </script>

</body>

</html>
