<!DOCTYPE html>
<html lang="en">

<head>
    <title>gemasulawesi.com Berita Terkini Indonesia Hari Ini</title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet'>

    <!-- Css -->
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/font-icons.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/style.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/colors/tosca.css" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ url('assets/frontend') }}/img/favicon.png">
    <link rel="apple-touch-icon" href="{{ url('assets/frontend') }}/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('assets/frontend') }}/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('assets/frontend') }}/img/apple-touch-icon-114x114.png">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Lazyload (must be placed in head in order to work) -->
    <script src="{{ url('assets/frontend') }}/js/lazysizes.min.js"></script>
</head>

<body class="home style-politics">
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
                $rubriks = \App\Models\Rubrik::get();
            @endphp
            <ul class="sidenav__menu" role="menubar">
                <!-- Categories -->
                @foreach ($rubriks as $rubrik)
                    <li>
                        <a href="{{route('category', ['rubrik_name'=>$rubrik->rubrik_name])}}" class="sidenav__menu-url">{{ $rubrik->rubrik_name }}</a>
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
        <!-- <div class="container">
      <div class="trending-now trending-now--1">
        <span class="trending-now__label">
          <i class="ui-flash"></i>
          <span class="trending-now__text d-lg-inline-block d-none">Newsflash</span>
        </span>
        <div class="newsticker">
          <ul class="newsticker__list">
            <li class="newsticker__item"><a href="single-post-politics.html" class="newsticker__item-url">A-HA theme is multi-purpose solution for any kind of business</a></li>
            <li class="newsticker__item"><a href="single-post-1.html" class="newsticker__item-url">Satelite cost tens of millions or even hundreds of millions of dollars to build</a></li>
            <li class="newsticker__item"><a href="single-post-3.html" class="newsticker__item-url">8 Hidden Costs of Starting and Running a Business</a></li>
          </ul>
        </div>
        <div class="newsticker-buttons">
          <button class="newsticker-button newsticker-button--prev" id="newsticker-button--prev" aria-label="next article"><i class="ui-arrow-left"></i></button>
          <button class="newsticker-button newsticker-button--next" id="newsticker-button--next" aria-label="previous article"><i class="ui-arrow-right"></i></button>
        </div>
      </div>
    </div>     -->

        <!-- Header -->
        <header class="header d-lg-block d-none">
            <div class="container">
                <div class="flex-parent">

                    <!-- Menu -->
                    <nav class="flex-child header__menu d-none d-lg-block">
                        <ul class="header__menu-list">
                            <li><a>{{ date('D, d M Y') }}</a></li>
                        </ul>
                    </nav>
                    <!-- end menu -->

                    <div class="flex-child text-center mt-3 mb-3">
                        <!-- Logo -->
                        <a href="{{ url('') }}" class="logo">
                            <img class="logo__img"
                                src="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp"
                                srcset="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp 1x, img/cropped-LOGO-GEMAS-1-2048x437.png.webp"
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
                            <!-- Side Menu Button Mobile -->
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
                                        <a href="{{route('category', ['rubrik_name'=>$rubrik->rubrik_name])}}" style="white-space: nowrap;">{{ $rubrik->rubrik_name }}</a>
                                    </li>
                                @endforeach

                            </ul> <!-- end menu -->
                        </nav> <!-- end nav-wrap -->

                        <!-- Logo Mobile -->
                        <a href="{{ url('') }}" class="logo logo-mobile d-lg-none">
                            <img class="logo__img"
                                src="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp"
                                srcset="{{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-768x164.png.webp 1x, {{ url('assets/frontend') }}/img/cropped-LOGO-GEMAS-1-2048x437.png.webp 2x"
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
                                        <a href="{{route('category', ['rubrik_name'=>$rubrik->rubrik_name])}}" style="white-space: nowrap;">{{ $rubrik->rubrik_name }}</a>
                                    </li>
                                @endforeach
                    </ul>
                </div>
            </div>
        </header> <!-- end navigation -->

        <!-- Ad Banner 728 -->
        <div class="text-center pb-48">
            <a href="#">
                <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg" alt="">
            </a>
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
                                <h4 class="widget-title">Useful Links</h4>
                                <ul>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="contact.html">News</a></li>
                                    <li><a href="categories.html">Advertise</a></li>
                                    <li><a href="shortcodes.html">Support</a></li>
                                    <li><a href="shortcodes.html">Features</a></li>
                                    <li><a href="shortcodes.html">Contact</a></li>
                                </ul>
                            </aside>
                        </div>

                        <!-- <div class="col-lg-4 col-md-6">
                            <aside class="widget widget-popular-posts">
                                <h4 class="widget-title">Popular Posts</h4>
                                <ul class="post-list-small">
                                    <li class="post-list-small__item">
                                        <article class="post-list-small__entry clearfix">
                                            <div class="post-list-small__img-holder">
                                                <div class="thumb-container thumb-100">
                                                    <a href="single-post.html">
                                                        <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_1.jpg"
                                                            src="{{ url('assets/frontend') }}/img/content/post_small/post_small_1.jpg" alt=""
                                                            class="post-list-small__img--roundedlazyload">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-list-small__body">
                                                <h3 class="post-list-small__entry-title">
                                                    <a href="single-post.html">Follow These Smartphone Habits of
                                                        Successful Entrepreneurs</a>
                                                </h3>
                                                <ul class="entry__meta">
                                                    <li class="entry__meta-author">
                                                        <span>by</span>
                                                        <a href="#">DeoThemes</a>
                                                    </li>
                                                    <li class="entry__meta-date">
                                                        Jan 21, 2018
                                                    </li>
                                                </ul>
                                            </div>
                                        </article>
                                    </li>
                                    <li class="post-list-small__item">
                                        <article class="post-list-small__entry clearfix">
                                            <div class="post-list-small__img-holder">
                                                <div class="thumb-container thumb-100">
                                                    <a href="single-post.html">
                                                        <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_2.jpg"
                                                            src="{{ url('assets/frontend') }}/img/content/post_small/post_small_2.jpg" alt=""
                                                            class="post-list-small__img--roundedlazyload">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-list-small__body">
                                                <h3 class="post-list-small__entry-title">
                                                    <a href="single-post.html">Lose These 12 Bad Habits If You're
                                                        Serious About Becoming a Millionaire</a>
                                                </h3>
                                                <ul class="entry__meta">
                                                    <li class="entry__meta-author">
                                                        <span>by</span>
                                                        <a href="#">DeoThemes</a>
                                                    </li>
                                                    <li class="entry__meta-date">
                                                        Jan 21, 2018
                                                    </li>
                                                </ul>
                                            </div>
                                        </article>
                                    </li>
                                </ul>
                            </aside>
                        </div> -->

                    </div>
                </div>
            </div> <!-- end container -->
        </footer> <!-- end footer -->

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

</body>

</html>
