<!DOCTYPE html>
<html lang="en">

<head>
    <title>Deus | Home 2 Politics</title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet'>

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/frontend/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/frontend/css/font-icons.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/frontend/css/style.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/frontend/css/colors/red.css" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets/frontend/img/favicon.ico">
    <link rel="apple-touch-icon" href="{{ asset('/') }}assets/frontend/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72"
        href="{{ asset('/') }}assets/frontend/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{ asset('/') }}assets/frontend/img/apple-touch-icon-114x114.png">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Lazyload (must be placed in head in order to work) -->
    <script src="{{ asset('/') }}assets/frontend/js/lazysizes.min.js"></script>

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
            <ul class="sidenav__menu" role="menubar">
                <!-- Categories -->
                <li>
                    <a href="#" class="sidenav__menu-url">World</a>
                </li>
                <li>
                    <a href="#" class="sidenav__menu-url">Business</a>
                </li>
                <li>
                    <a href="#" class="sidenav__menu-url">Fashion</a>
                </li>
                <li>
                    <a href="#" class="sidenav__menu-url">Lifestyle</a>
                </li>
                <li>
                    <a href="#" class="sidenav__menu-url">Advertise</a>
                </li>
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
                            <li><a>Rabu, 13 September 2023</a></li>
                        </ul>
                    </nav>
                    <!-- end menu -->

                    <div class="flex-child text-center mt-3 mb-3">
                        <!-- Logo -->
                        <a href="index.html" class="logo">
                            <img class="logo__img"
                                src="{{ asset('/') }}assets/frontend/img/cropped-LOGO-GEMAS-1-768x164.png.webp"
                                srcset="{{ asset('/') }}assets/frontend/img/cropped-LOGO-GEMAS-1-768x164.png.webp 1x, {{ asset('/') }}assets/frontend/img/cropped-LOGO-GEMAS-1-2048x437.png.webp"
                                alt="logo" width="280" height="280">
                        </a>
                    </div>

                    <!-- Socials -->
                    <div class="flex-child">
                        <div class="socials socials--nobase socials--large socials--dark justify-content-end">
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
                    <div class="flex-parent">

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
                                <li>
                                    <a href="#">Category</a>
                                </li>
                                <li>
                                    <a href="#">Category</a>
                                </li>
                                <li>
                                    <a href="#">Category</a>
                                </li>
                                <li>
                                    <a href="#">Category</a>
                                </li>
                                <li>
                                    <a href="#">Category</a>
                                </li>
                                <li>
                                    <a href="#">Category</a>
                                </li>
                                <li>
                                    <a href="#">Category</a>
                                </li>
                                <li>
                                    <a href="#">Category</a>
                                </li>
                                <li>
                                    <a href="#">Category</a>
                                </li>

                            </ul> <!-- end menu -->
                        </nav> <!-- end nav-wrap -->

                        <!-- Logo Mobile -->
                        <a href="index.html" class="logo logo-mobile d-lg-none">
                            <img class="logo__img"
                                src="{{ asset('/') }}assets/frontend/img/cropped-LOGO-GEMAS-1-768x164.png.webp"
                                srcset="{{ asset('/') }}assets/frontend/img/cropped-LOGO-GEMAS-1-768x164.png.webp 1x, {{ asset('/') }}assets/frontend/img/cropped-LOGO-GEMAS-1-2048x437.png.webp 2x"
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
        </header> <!-- end navigation -->

        <!-- Ad Banner 728 -->
        <div class="text-center pb-48">
            <a href="#">
                <img src="{{ asset('/') }}assets/frontend/img/content/placeholder_728.jpg" alt="">
            </a>
        </div>

        <div class="main-container container" id="main-container">
            <!-- Content -->
            <div class="row row-20">

                <!-- slider -->
                <div class="col-lg-8 order-lg-2">

                    <section>
                        <div class="owl-carousel owl-carousel-thumbs" data-slider-id="5">
                            <div>
                                <article class="entry thumb--size-3 mb-0">
                                    <div class="entry__img-holder thumb__img-holder"
                                        style="background-image: url('{{ asset('/') }}assets/frontend/img/content/hero/hero_post_5.jpg');">
                                        <div class="bottom-gradient"></div>
                                        <div class="thumb-text-holder thumb-text-holder--2">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">politics</a>
                                                </li>
                                            </ul>
                                            <h2 class="thumb-entry-title">
                                                <a href="single-post-politics.html">Trump endorses raising minimum age
                                                    for more
                                                    weapons, revives idea of arming teachers</a>
                                            </h2>
                                            <ul class="entry__meta">
                                                <li class="entry__meta-views">
                                                    <i class="ui-eye"></i>
                                                    <span>1356</span>
                                                </li>
                                                <li class="entry__meta-comments">
                                                    <a href="#">
                                                        <i class="ui-chat-empty"></i>13
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="single-post-politics.html" class="thumb-url"></a>
                                    </div>
                                </article>
                            </div>
                            <div>
                                <article class="entry thumb--size-3 mb-0">
                                    <div class="entry__img-holder thumb__img-holder"
                                        style="background-image: url('{{ asset('/') }}assets/frontend/img/content/hero/hero_post_13.jpg');">
                                        <div class="bottom-gradient"></div>
                                        <div class="thumb-text-holder thumb-text-holder--2">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">politics</a>
                                                </li>
                                            </ul>
                                            <h2 class="thumb-entry-title">
                                                <a href="single-post-politics.html">Extreme Heat Waves Will Change How
                                                    We Live. We're Not Ready</a>
                                            </h2>
                                            <ul class="entry__meta">
                                                <li class="entry__meta-views">
                                                    <i class="ui-eye"></i>
                                                    <span>1356</span>
                                                </li>
                                                <li class="entry__meta-comments">
                                                    <a href="#">
                                                        <i class="ui-chat-empty"></i>13
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="single-post-politics.html" class="thumb-url"></a>
                                    </div>
                                </article>
                            </div>
                            <div>
                                <article class="entry thumb--size-3 mb-0">
                                    <div class="entry__img-holder thumb__img-holder"
                                        style="background-image: url('{{ asset('/') }}assets/frontend/img/content/hero/hero_post_20.jpg');">
                                        <div class="bottom-gradient"></div>
                                        <div class="thumb-text-holder thumb-text-holder--2">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">politics</a>
                                                </li>
                                            </ul>
                                            <h2 class="thumb-entry-title">
                                                <a href="single-post-politics.html">Trump endorses raising minimum age
                                                    for more
                                                    weapons, revives idea of arming teachers</a>
                                            </h2>
                                            <ul class="entry__meta">
                                                <li class="entry__meta-views">
                                                    <i class="ui-eye"></i>
                                                    <span>1356</span>
                                                </li>
                                                <li class="entry__meta-comments">
                                                    <a href="#">
                                                        <i class="ui-chat-empty"></i>13
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="single-post-politics.html" class="thumb-url"></a>
                                    </div>
                                </article>
                            </div>
                            <div>
                                <article class="entry thumb--size-3 mb-0">
                                    <div class="entry__img-holder thumb__img-holder"
                                        style="background-image: url('{{ asset('/') }}assets/frontend/img/content/hero/hero_post_21.jpg');">
                                        <div class="bottom-gradient"></div>
                                        <div class="thumb-text-holder thumb-text-holder--2">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="#" class="entry__meta-category">politics</a>
                                                </li>
                                            </ul>
                                            <h2 class="thumb-entry-title">
                                                <a href="single-post-politics.html">Trump endorses raising minimum age
                                                    for more
                                                    weapons, revives idea of arming teachers</a>
                                            </h2>
                                            <ul class="entry__meta">
                                                <li class="entry__meta-views">
                                                    <i class="ui-eye"></i>
                                                    <span>1356</span>
                                                </li>
                                                <li class="entry__meta-comments">
                                                    <a href="#">
                                                        <i class="ui-chat-empty"></i>13
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="single-post-politics.html" class="thumb-url"></a>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="owl-thumbs row mb-4 d-none d-md-flex w-100 mx-auto" data-slider-id="5">
                            <button class="owl-thumb-item col-3 p-0">
                                <div class="thumb-item">
                                    <img src="{{ asset('/') }}assets/frontend/img/content/hero/hero_post_5.jpg"
                                        class="w-100" style="object-fit: cover;height: 149px;object-position: top;"
                                        alt="">
                                    <a href="1" class="bg-black p-2">Trump endorses raising minimum age for more
                                        weapons, revives </a>
                                </div>
                            </button>
                            <button class="owl-thumb-item col-3 p-0 ">
                                <div class="thumb-item">
                                    <img src="{{ asset('/') }}assets/frontend/img/content/hero/hero_post_13.jpg"
                                        class="w-100" style="object-fit: cover;height: 149px;object-position: top;"
                                        alt="">
                                    <a class="bg-black p-2" href="">Extreme Heat Waves Will Change How
                                        We Live. We're Not Ready</a>
                                </div>
                            </button>
                            <button class="owl-thumb-item col-3 p-0">
                                <div class="thumb-item">
                                    <img src="{{ asset('/') }}assets/frontend/img/content/hero/hero_post_20.jpg"
                                        class="w-100" style="object-fit: cover;height: 149px;object-position: top;"
                                        alt="">
                                    <a class="bg-black p-2" href="">Extreme Heat Waves Will Change How
                                        We Live. We're Not Ready</a>
                                </div>
                            </button>
                            <button class="owl-thumb-item col-3 p-0">
                                <div class="thumb-item">
                                    <img src="{{ asset('/') }}assets/frontend/img/content/hero/hero_post_21.jpg"
                                        class="w-100" style="object-fit: cover;height: 149px;object-position: top;"
                                        alt="">
                                    <a class="bg-black p-2" href="">Extreme Heat Waves Will Change How
                                        We Live. We're Not Ready</a>
                                </div>
                            </button>
                        </div>
                        <!-- <article class="entry thumb--size-3 mb-0">
                            <div class="entry__img-holder thumb__img-holder"
                                style="background-image: url('{{ asset('/') }}assets/frontend/img/content/hero/hero_post_5.jpg');">
                                <div class="bottom-gradient"></div>
                                <div class="thumb-text-holder thumb-text-holder--2">
                                    <ul class="entry__meta">
                                        <li>
                                            <a href="#" class="entry__meta-category">politics</a>
                                        </li>
                                    </ul>
                                    <h2 class="thumb-entry-title">
                                        <a href="single-post-politics.html">Trump endorses raising minimum age for more
                                            weapons, revives idea of arming teachers</a>
                                    </h2>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-views">
                                            <i class="ui-eye"></i>
                                            <span>1356</span>
                                        </li>
                                        <li class="entry__meta-comments">
                                            <a href="#">
                                                <i class="ui-chat-empty"></i>13
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <a href="single-post-politics.html" class="thumb-url"></a>
                            </div>
                        </article> -->
                        <div class="title-wrap--line"></div>
                        <div class="pilihan-editor">
                            <div class="title-wrap">
                                <h3 class="section-title">pilihan editor</h3>
                            </div>

                            <!-- Slider -->
                            <div class="wrap-owl">
                                <div id="owl-posts-3-items"
                                    class="owl-carousel owl-theme owl-carousel--arrows-outside">
                                    <article class="entry">
                                        <div class="entry__img-holder">
                                            <a href="single-post-politics.html">
                                                <div class="thumb-container thumb-65">
                                                    <img data-src="{{ asset('/') }}assets/frontend/img/content/carousel/carousel_post_5.jpg"
                                                        src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                        class="entry__img lazyload" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="entry__body">
                                            <div class="entry__header">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="#" class="entry__meta-category">category</a>
                                                    </li>
                                                </ul>
                                                <h2 class="entry__title">
                                                    <a href="single-post-politics.html">Federal budget to spend up to
                                                        $1
                                                        billion on cybersecurity</a>
                                                </h2>
                                                <p class="bt__date">14 September 2023, 15:41 WIB</p>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="entry">
                                        <div class="entry__img-holder">
                                            <a href="single-post-politics.html">
                                                <div class="thumb-container thumb-65">
                                                    <img data-src="{{ asset('/') }}assets/frontend/img/content/carousel/carousel_post_6.jpg"
                                                        src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                        class="entry__img lazyload" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="entry__body">
                                            <div class="entry__header">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="#" class="entry__meta-category">elizabeth
                                                            Green</a>
                                                    </li>
                                                </ul>
                                                <h2 class="entry__title">
                                                    <a href="single-post-politics.html">US Administration is Waging a
                                                        Silent
                                                        War on Asylum Seekers</a>
                                                </h2>
                                                <p class="bt__date">14 September 2023, 15:41 WIB</p>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="entry">
                                        <div class="entry__img-holder">
                                            <a href="single-post-politics.html">
                                                <div class="thumb-container thumb-65">
                                                    <img data-src="{{ asset('/') }}assets/frontend/img/content/carousel/carousel_post_7.jpg"
                                                        src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                        class="entry__img lazyload" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="entry__body">
                                            <div class="entry__header">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="#" class="entry__meta-category">john doe</a>
                                                    </li>
                                                </ul>
                                                <h2 class="entry__title">
                                                    <a href="single-post-politics.html">U.S. To Expel 60 Russian
                                                        Foreign
                                                        Service Officers</a>
                                                </h2>
                                                <p class="bt__date">14 September 2023, 15:41 WIB</p>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="entry">
                                        <div class="entry__img-holder">
                                            <a href="single-post-politics.html">
                                                <div class="thumb-container thumb-65">
                                                    <img data-src="{{ asset('/') }}assets/frontend/img/content/carousel/carousel_post_8.jpg"
                                                        src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                        class="entry__img lazyload" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="entry__body">
                                            <div class="entry__header">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="#" class="entry__meta-category">kathlyn
                                                            wood</a>
                                                    </li>
                                                </ul>
                                                <h2 class="entry__title">
                                                    <a href="single-post-politics.html">John Bolton, North Korea and
                                                        the
                                                        Art
                                                        of the Deal</a>
                                                </h2>
                                                <p class="bt__date">14 September 2023, 15:41 WIB</p>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="entry">
                                        <div class="entry__img-holder">
                                            <a href="single-post-politics.html">
                                                <div class="thumb-container thumb-65">
                                                    <img data-src="{{ asset('/') }}assets/frontend/img/content/carousel/carousel_post_6.jpg"
                                                        src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                        class="entry__img lazyload" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="entry__body">
                                            <div class="entry__header">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="#" class="entry__meta-category">elizabeth
                                                            Green</a>
                                                    </li>
                                                </ul>
                                                <h2 class="entry__title">
                                                    <a href="single-post-politics.html">US Administration is Waging a
                                                        Silent
                                                        War on Asylum Seekers</a>
                                                </h2>
                                                <p class="bt__date">14 September 2023, 15:41 WIB</p>
                                            </div>
                                        </div>
                                    </article>
                                </div> <!-- end slider -->
                                <div class="wrap-btn-slider">
                                    <div class="btn-slider">
                                        <button class="btn-prev" id="prevPost3"><i
                                                class="ui-arrow-left"></i></button>
                                        <button class="btn-nect" id="nextPost3"><i
                                                class="ui-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div> <!-- end slider -->

                <!-- Sidebar -->
                <!-- end sidebar -->

                <!-- Sidebar -->
                <aside class="col-lg sidebar order-lg-3">
                    <!-- Widget Popular Posts -->
                    <aside class="widget widget-popular-posts">
                        <h4 class="widget-title">Weekly Popular</h4>
                        <ul class="post-list-small post-list-small--1">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-80">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/post_small/post_small_5.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">Barack Obama and Family Visit Balinese
                                                Paddy Fields</a>
                                        </h3>
                                    </div>
                                </article>
                            </li>
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-80">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/post_small/post_small_6.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">Liberals to outline long-term
                                                Indigenous
                                                housing plan in budge</a>
                                        </h3>
                                    </div>
                                </article>
                            </li>
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-80">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/post_small/post_small_7.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">5 Pieces of Hard-Won Wisdom From
                                                Billionaire Warren Buffett</a>
                                        </h3>
                                    </div>
                                </article>
                            </li>
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-80">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/post_small/post_small_8.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">Liberals to outline long-term
                                                Indigenous
                                                housing plan in budge</a>
                                        </h3>
                                    </div>
                                </article>
                            </li>
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-80">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/post_small/post_small_9.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">This Secret Room In Mount Rushmore Is
                                                Having A Moment</a>
                                        </h3>
                                    </div>
                                </article>
                            </li>
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-80">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/post_small/post_small_10.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">California Democrats' snub of party
                                                icon
                                                Dianne Feinstein</a>
                                        </h3>
                                    </div>
                                </article>
                            </li>
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-80">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/post_small/post_small_11.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">How To Find Protests In Your City When
                                                You Don’t Know Where To Start</a>
                                        </h3>
                                    </div>
                                </article>
                            </li>
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-80">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/post_small/post_small_12.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">Extreme Heat Waves Will Change How We
                                                Live. We’re Not Ready</a>
                                        </h3>
                                    </div>
                                </article>
                            </li>
                        </ul>
                    </aside> <!-- end widget popular posts -->
                </aside> <!-- end sidebar -->

            </div> <!-- end content -->

            <!-- Pilihan Editor -->
            <section class=" mb-24 col-lg-8">

            </section> <!-- end carousel posts -->

            <!-- Berita Terkini -->
            <section class=" mb-32">
                <div class="title-wrap title-wrap--line">
                    <h3 class="section-title">Berita Terkini</h3>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/grid/grid_post_1.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration camp':
                                                Bangladesh defends plan to house Rohingya on island with armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/grid/grid_post_2.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration camp':
                                                Bangladesh defends plan to house Rohingya on island with armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/grid/grid_post_3.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration camp':
                                                Bangladesh defends plan to house Rohingya on island with armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/grid/grid_post_4.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration camp':
                                                Bangladesh defends plan to house Rohingya on island with armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ asset('/') }}assets/frontend/img/content/grid/grid_post_5.jpg"
                                                    src="{{ asset('/') }}assets/frontend/img/empty.png"
                                                    alt="" class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration camp':
                                                Bangladesh defends plan to house Rohingya on island with armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>

                        <!-- Ad Banner 728 -->
                        <div class="text-center pb-48">
                            <a href="#">
                                <img src="{{ asset('/') }}assets/frontend/img/content/placeholder_728.jpg"
                                    alt="">
                            </a>
                        </div>

                    </div>
                    <div class="col-lg-4 text-right text-md-center">
                        <a href="#">
                            <img src="{{ asset('/') }}assets/frontend/img/content/placeholder_300_600.jpg"
                                alt="">
                        </a>
                    </div>
                </div>
            </section> <!-- end most viewed -->

        </div> <!-- end main container -->

        <!-- Footer -->
        <footer class="footer footer--1">
            <div class="container">
                <div class="footer__widgets footer__widgets--short top-divider">
                    <div class="row">

                        <div class="col-lg-6">
                            <ul class="footer__nav-menu">
                                <li><a href="about.html">About</a></li>
                                <li><a href="contact.html">News</a></li>
                                <li><a href="categories.html">Advertise</a></li>
                                <li><a href="shortcodes.html">Support</a></li>
                                <li><a href="shortcodes.html">Features</a></li>
                                <li><a href="shortcodes.html">Contact</a></li>
                            </ul>
                            <p class="copyright">
                                &copy;
                                <script>
                                    document.querySelector(".copyright").innerHTML += new Date().getFullYear();
                                </script>
                                Gema Sulawesi</a>
                            </p>
                        </div>

                        <div class="col-lg-6">
                            <div class="socials socials--large socials--rounded justify-content-lg-end">
                                <a href="#" class="social social-facebook" aria-label="facebook"><i
                                        class="fa-brands fa-facebook"></i></i></a>
                                <a href="#" class="social social-twitter" aria-label="twitter"><i
                                        class="fa-brands fa-square-x-twitter"></i></a>
                                <a href="#" class="social social-youtube" aria-label="youtube"><i
                                        class="fa-brands fa-youtube"></i></a>
                                <a href="#" class="social social-instagram" aria-label="instagram"><i
                                        class="fa-brands fa-square-instagram"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end container -->
        </footer> <!-- end footer -->

        <div id="back-to-top">
            <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
        </div>

    </main> <!-- end main-wrapper -->

    <!-- jQuery Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel2.thumbs@0.1.8/dist/owl.carousel2.thumbs.min.js"></script>
    <script src="{{ asset('/') }}assets/frontend/js/jquery.min.js"></script>
    <script src="{{ asset('/') }}assets/frontend/js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}assets/frontend/js/easing.min.js"></script>
    <script src="{{ asset('/') }}assets/frontend/js/owl-carousel.min.js"></script>
    <script src="js/flickity.pkgd.min.js"></script>
    <script src="{{ asset('/') }}assets/frontend/js/twitterFetcher_min.js"></script>
    <script src="{{ asset('/') }}assets/frontend/js/jquery.newsTicker.min.js"></script>
    <script src="{{ asset('/') }}assets/frontend/js/modernizr.min.js"></script>
    <script src="{{ asset('/') }}assets/frontend/js/scripts.js"></script>

</body>

</html>
