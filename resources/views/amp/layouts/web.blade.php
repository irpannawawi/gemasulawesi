<!DOCTYPE html>
<html amp lang="en">
@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    $breakingNews = App\Models\Breakingnews::get();
    use App\Models\Rubrik;
    $rubriks = Rubrik::get();
    $baseUrl = URL::to('');

    $subTitle = get_setting('sub_title');
    if (request()->is('/')) {
        $metaTitle = get_setting('title') . ' - ' . $subTitle;
        $metaDeskripsi = get_setting('meta_google');
        $metaImage = Storage::url('logo/') . get_setting('logo_web');
        $type = 'website';
    } else {
        $postTitle = $post->title ?? '';
        $metaTitle = $postTitle . ' - ' . $subTitle;
        $metaDeskripsi = $post->description;
        $imagePath = get_post_image($post->post_id) ?? '';
        $metaImage = asset($imagePath);
        $type = 'article';
        $category = $post->rubrik->rubrik_name;
        $tags = $post->tags;
    }
@endphp

<head>
    <meta charset="utf-8">
    <title itemprop="name">{{ $metaTitle }}</title>
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <link href="{{ $metaImage }}" itemprop="image" />
    <link href="{{ Storage::url('favicon/') . get_setting('favicon') }}" rel="icon" type="image/ico" />
    <link rel="apple-touch-icon-precomposed" href="{{ Storage::url('favicon/') . get_setting('favicon') }}">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="title" content="{{ $metaTitle }}" />
    <meta name="description" content="{{ $metaDeskripsi }}" itemprop="description">
    <meta name="thumbnailUrl" content="{{ $metaImage }}" itemprop="thumbnailUrl" />
    <meta name="base" content="https://www.gemasulawesi.com/" />
    <meta name="robots" content="index,follow" />
    <meta name="googlebot-news" content="index,follow" />
    <meta name="googlebot" content="index,follow" />
    <!-- e: open graph -->

    {{-- amp project --}}
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0.js">
    <link rel="preconnect dns-prefetch" href="https://fonts.gstatic.com/" crossorigin>
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
    <script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
    <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>

    <script async custom-element="amp-sticky-ad" src="https://cdn.ampproject.org/v0/amp-sticky-ad-1.0.js"></script>

    <script async custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js"></script>
    <script async custom-element="amp-facebook" src="https://cdn.ampproject.org/v0/amp-facebook-0.1.js"></script>

    @if (!empty($post))
        @php
            $shouldDisplayJsonLD = true;
            if ($shouldDisplayJsonLD) {
                preg_match('/<img src="(.*?)">/', $post->article, $matches);
                $imagePath = $matches[1] ?? ''; // Jika tidak ada gambar, setel ke string kosong
                $image = asset($imagePath);
                $segments = request()->segments();
                $lastSegment = end($segments);
                $postTitle = $post->title ?? '';
                $jsonLDData = [
                    '@context' => 'https://schema.org',
                    '@type' => 'NewsArticle',
                    'mainEntityOfPage' => url()->current(),
                    'datePublished' => $post->created_at,
                    'dateModified' => $post->updated_at,
                    'description' => $post->description,
                    'headline' => $postTitle,
                    'author' => [
                        '@type' => 'Person',
                        'url' => url()->current(),
                        'name' => $post->editor->display_name ?? 'Tim Gema',
                    ],
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => 'www.gemasulawesi.com',
                        'logo' => [
                            '@type' => 'ImageObject',
                            'url' => Storage::url('favicon/') . get_setting('favicon'),
                        ],
                    ],
                    'image' => [
                        '@type' => 'ImageObject',
                        'url' => $image,
                    ],
                    'vars' => [
                        'published_date' => $post->created_at,
                        'rubrik' => $post->rubrik->rubrik_name,
                        'penulis' => $post->author->display_name,
                        'editor' => '',
                        'id' => $post->post_id,
                        'source' => '',
                        'topic' => '',
                        'tag' => $post->tags,
                        'penulis_id' => $post->author->author_id,
                        'editor_id' => $post->author->editor_id,
                    ],
                ];
                $jsonLD = json_encode($jsonLDData, JSON_PRETTY_PRINT);
                echo '<script type="application/ld+json">
                ' . $jsonLD. '
                </script>';
            }
        @endphp
    @endif

    <style amp-boilerplate>
        body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @-ms-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }
    </style>

    <noscript>
        <style amp-boilerplate>
            body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none
            }
        </style>
    </noscript>

    <style amp-custom>
        /* Reset some default styles */
        body,
        h1,
        h2,
        h3,
        p {
            margin: 0;
            padding: 0;
        }

        /* Set max-width to center content on larger screens */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Add some spacing between elements */
        .mb-2 {
            margin-bottom: 2rem;
        }

        /* Create a basic grid system */
        .row {
            display: flex;
            margin: 0 -15px;
        }

        .col {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }

        /* Add some padding to the columns */
        .p-4 {
            padding: 1rem;
        }


        :root {
            --blue: #007bff;
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #e83e8c;
            --red: #dc3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary: #007bff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #2cc38b;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
            --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
                "Segoe UI Emoji", "Segoe UI Symbol";
            --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas,
                "Liberation Mono", "Courier New", monospace;
        }

        @media print {

            *,
            :after,
            :before {
                text-shadow: none;
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            a:not(.btn) {
                text-decoration: underline;
            }

            p {
                orphans: 3;
                widows: 3;
            }

            @page {
                size: a3;
            }

            body {
                min-width: 992px;
            }

            .container {
                min-width: 992px;
            }
        }

        *,
        :after,
        :before {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -ms-overflow-style: scrollbar;
            -webkit-tap-highlight-color: transparent;
        }

        footer,
        header,
        main,
        nav {
            display: block;
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
                "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        ul {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        ul ul {
            margin-bottom: 0;
        }

        b {
            font-weight: bolder;
        }

        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        a:not([href]):not([tabindex]) {
            color: inherit;
            text-decoration: none;
        }

        a:not([href]):not([tabindex]):focus,
        a:not([href]):not([tabindex]):hover {
            color: inherit;
            text-decoration: none;
        }

        a:not([href]):not([tabindex]):focus {
            outline: 0;
        }

        button {
            border-radius: 0;
        }

        button:focus {
            outline: 1px dotted;
            outline: 5px auto -webkit-focus-ring-color;
        }

        button,
        input {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button,
        input {
            overflow: visible;
        }

        button {
            text-transform: none;
        }

        [type="submit"],
        button {
            -webkit-appearance: button;
        }

        [type="submit"]::-moz-focus-inner,
        button::-moz-focus-inner {
            padding: 0;
            border-style: none;
        }

        ::-webkit-file-upload-button {
            font: inherit;
            -webkit-appearance: button;
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 1094px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1096px;
            }
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-12,
        .col-md-6 {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {

            .col-md-6 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (min-width: 992px) {

            .col-lg-3 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%;
            }

            .col-lg-4 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 33.33333%;
                flex: 0 0 33.33333%;
                max-width: 33.33333%;
            }

            .col-lg-5 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 41.66667%;
                flex: 0 0 41.66667%;
                max-width: 41.66667%;
            }

            .col-lg-12 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .close:not(:disabled):not(.disabled) {
            cursor: pointer;
        }

        .d-none {
            display: none;
        }

        .d-block {
            display: block;
        }

        .d-flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        @media (min-width: 576px) {
            .d-sm-none {
                display: none;
            }
        }

        @media (min-width: 992px) {
            .d-lg-none {
                display: none;
            }

            .d-lg-inline-block {
                display: inline-block;
            }

            .d-lg-block {
                display: block;
            }
        }

        .justify-content-end {
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: flex-end;
        }

        .align-items-center {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .py-2 {
            padding-top: 0.5rem;
        }

        .py-2 {
            padding-bottom: 0.5rem;
        }

        /* custom */
        .nav__home {
            position: absolute;
        }

        @media only screen and (max-width: 480px) {
            .nav--colored .nav__holder {
                background-color: #fff;
                box-shadow: 0 3px 4px 0 rgba(0, 0, 0, .2);
            }
        }

        @media only screen and (max-width: 990px) {
            .nav--colored .nav__holder {
                background-color: #fff;
                padding: 10px 0 55px 0;
            }
        }

        .category_under_nav {
            background-color: #2cc38b;
        }

        .category_under_nav li a {
            color: #fff;
            font-weight: 700;
        }

        .category_under_nav li a:hover {
            color: #333;
            font-weight: 700;
        }



        /* home button */
        .nav__home {
            left: -25px;
            z-index: 1;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -ms-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
            transition: all 0.2s ease;
            display: inline-block;
            cursor: pointer;
            margin-right: 20px;
            overflow: visible;
            text-transform: none;
            border: 0;
        }

        @media (max-width: 768px) {
            .nav__home {
                display: none;
            }
        }

        .icon {
            color: #fff;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 100%;
            display: block;
            font-size: 16px;
        }

        .icon:hover {
            color: #000;
            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -ms-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        @media (min-width: 576px) {
            .kontiner {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .kontiner {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .kontiner {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .kontiner {
                max-width: 1140px;
            }
        }

        @media (min-width: 1280px) {
            .kontiner {
                max-width: 1100px;
                margin-right: auto;
                margin-left: auto;
                padding-right: 15px;
                padding-left: 15px;
            }
        }

        .kontiner {
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }

        .trending-now--1 .newsticker {
            border: 1px solid #e3e4e8;
        }

        .newsticker {
            padding-right: 9px;
            height: 36px;
            overflow: hidden;
        }

        .newsticker__list {
            display: flex;
        }

        .newsticker__item {
            flex-shrink: 0;
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            text-align: center;
        }

        @keyframes tickerh {
            0% {
                transform: translate3d(100%, 0, 0);
            }

            100% {
                transform: translate3d(-400%, 0, 0);
            }
        }

        .newsticker__list {
            animation: tickerh linear 35s infinite;
        }

        .newsticker__list:hover {
            animation-play-state: paused;
        }

        @media only screen and (max-width: 768px) {
            .newsticker__list {
                animation-duration: 20s;
            }
        }

        .newsticker__item-url {
            color: #54555e;
        }

        .newsticker__item-url:hover {
            color: #2d95e3;
        }

        /*-------------------------------------------------------*/
        /* Footer
/*-------------------------------------------------------*/
        .footer {
            margin-top: 42px;
            background: #000;
            color: #fff;
            border-top: 4px solid #2cc38b;
            background: #ffffff;
            color: #000;
        }

        .footer__widgets {
            padding: 50px 0 20px 0;
        }

        .footer__widgets p {
            font-size: 14px;
            line-height: 26px;
        }

        @media only screen and (max-width: 991px) {
            .footer__widgets>.row>div:not(:last-child) {
                margin-bottom: 10px;
            }
        }

        /* footer old */
        @media only screen and (max-width: 768px) {
            .social__footer {
                text-align: center;
            }
        }

        .social__footer {
            margin-top: 10px;
        }

        /* footer */
        .footer__logo {
            padding: 0 0 15px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            justify-content: flex-start;
            border-color: #e7e7e7;
            align-items: center;
            position: relative;
        }

        .footer__logo a {
            position: relative;
            z-index: 2;
            padding: 0 10px 0 0;
            display: inline-block;
        }

        .footer__contact {
            line-height: 1.5;
        }

        .footer p {
            margin: 0;
        }

        .footer__verifikasi {
            line-height: 1.5;
        }

        .footer__menu {
            position: relative;
            padding: 0;
        }

        @media (max-width: 768px) {
            .footer__menu {
                position: relative;
                padding: 0;
                text-align: center;
            }

            .footer__item {
                padding: 0;
                position: relative;
                display: inline-block;
            }

            .footer__logo {
                justify-content: center;
            }

            .footer {
                text-align: center;
            }
        }

        .footer__item {
            position: relative;
            padding: 0;
            display: block;
        }

        .footer__link {
            padding: 5px 0;
            display: block;
            font-size: 14px;
        }

        .footer__copyright {
            border-top: 1px solid rgba(255, 255, 255, .2);
            font-size: 14px;
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
        }

        .footer__copyright {
            border-color: #e7e7e7;
        }

        .footer__copyright {
            align-items: center;
            position: relative;
        }

        /* Title category page */

        /* indeks */

        /* ads banner */
        .ads__banner {
            padding-bottom: 1.5rem;
        }

        /* Layar kecil seperti smartphone vertikal */
        /* Tablet vertikal */
        /* pagination page */

        .nav__search-trigger-lg {
            font-size: 30px;
            color: #2CC38B;
        }

        .nav {
            min-height: 48px;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            z-index: unset;
            position: unset;
            -webkit-transition: height 0.3s ease-in-out;
            transition: height 0.3s ease-in-out;
            /* Dropdowns (large screen) */
        }

        .nav__lainnya {
            margin-left: auto;
        }

        /* Style for the submenu */
        .menu__lainnya {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        /* .menu__lainnya li {
    margin-right: 10px;
} */
        .submenu {
            right: -20px;
            border-radius: 5px;
            z-index: 99;
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 180px;
            max-height: 500px;
            overflow-y: auto;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .submenu li {
            padding: 10px;
        }

        .submenu li:hover {
            color: #2CC38B;
        }

        .submenu::-webkit-scrollbar {
            width: 8px;
        }

        .submenu::-webkit-scrollbar-thumb {
            background-color: #bdbdbd;
            border-radius: 4px;
        }

        .submenu::-webkit-scrollbar-track {
            background-color: #f9f9f9;
        }

        .link-submenu {
            text-decoration: none;
            color: black;
            display: block;
        }

        .link-submenu:hover {
            color: #2CC38B;
        }

        /* Style for the hover effect */
        .menu__lainnya li:hover .submenu {
            display: block;
        }

        /* google news */
        /* 404 not found */
        @media (min-width: 767px) {
            .footer__verifikasi {
                margin-top: 10px;
                background: #72f3c4;
                color: #000;
                align-items: center;
                display: flex;
                width: fit-content;
                padding: 0.5em;
                border-radius: 10px;
                font-weight: 500;
            }
        }

        .footer__verifikasi {
            margin-top: 10px;
            background: #72f3c4;
            color: #000;
            align-items: center;
            padding: 0.5em;
            border-radius: 10px;
            font-weight: 500;
        }


        .oh {
            overflow: hidden;
        }

        .relative {
            position: relative;
        }

        ::-moz-selection {
            color: #333;
            background: #fbedc4;
        }

        ::-webkit-selection {
            color: #333;
            background: #fbedc4;
        }

        ::selection {
            color: #333;
            background: #fbedc4;
        }

        html {
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: #171821;
        }

        a:hover,
        a:focus {
            text-decoration: none;
            color: #171821;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "Source Sans Pro", sans-serif;
            font-size: 15px;
            line-height: 1.5;
            font-smoothing: antialiased;
            -webkit-font-smoothing: antialiased;
            background: #fff;
            outline: 0;
            overflow-x: hidden;
            overflow-y: auto;
            color: #54555e;
            width: 100%;
            height: 100%;
        }


        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        p {
            font-size: 16px;
            color: #000;
            font-weight: normal;
            line-height: 26px;
            margin: 0 0 10px;
        }

        .text-center {
            text-align: center;
        }

        @media (min-width: 1280px) {
            .container {
                max-width: 1096px;
                margin-right: auto;
                margin-left: auto;
                padding-right: 15px;
                padding-left: 15px;
            }
        }

        .flex-parent {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-flow: row nowrap;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            flex-flow: row nowrap;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .flex-child {
            -webkit-box-flex: 1 0 0;
            -ms-flex: 1 0 0;
            flex: 1 0 0;
        }

        .btn {
            font-weight: 700;
            font-family: "Source Sans Pro", sans-serif;
            overflow: hidden;
            display: inline-block;
            text-decoration: none;
            text-align: center;
            border: 0;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            color: #fff;
            background-color: #171821;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            position: relative;
            z-index: 1;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .btn:hover {
            color: #fff;
            background-color: #171821;
            border-color: transparent;
        }

        .btn:focus {
            outline: none;
            color: #fff;
        }

        .btn-lg,
        .btn-lg.btn-button {
            font-size: 14px;
            padding: 0 16px;
        }

        .btn-lg.btn-button {
            height: 46px;
        }

        .btn-color {
            background-color: #2d95e3;
        }

        .btn-color:hover {
            opacity: 0.92;
        }

        .btn i {
            font-size: 10px;
            position: relative;
            margin-left: 3px;
            top: -1px;
            line-height: 1;
        }

        .btn-button {
            border: none;
            margin-bottom: 0;
            width: auto;
        }

        .btn-button.btn-color {
            color: #fff;
        }

        .btn-button:hover,
        .btn-button:focus {
            color: #fff;
            background-color: #171821;
        }

        /*-------------------------------------------------------*/
        /* Form Elements
/*-------------------------------------------------------*/
        input {
            height: 46px;
            border: 1px solid #e3e4e8;
            background-color: #fff;
            width: 100%;
            margin-bottom: 24px;
            padding: 0 12px;
            -webkit-transition: border-color 0.3s ease-in-out,
                background-color 0.3s ease-in-out;
            transition: border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        button {
            -webkit-appearance: button;
            cursor: pointer;
        }

        input:focus {
            border-color: #2d95e3;
            background-color: #fff;
            outline: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        /* Change Color of Placeholders */
        input::-webkit-input-placeholder {
            color: #54555e;
        }

        input:-moz-placeholder {
            color: #54555e;
            opacity: 1;
        }

        input::-moz-placeholder {
            color: #54555e;
            opacity: 1;
        }

        input:-ms-input-placeholder {
            color: #54555e;
        }


        button::-moz-focus-inner {
            padding: 0;
            border: 0;
        }

        .socials {
            overflow: hidden;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .socials--nobase a {
            width: 13px;
            height: auto;
            border: 0;
            line-height: 32px;
            margin-right: 15px;
            margin-bottom: 0;
            color: #54555e;
            background-color: transparent;
            float: right;
        }

        .socials--nobase a:hover,
        .socials--nobase a:focus {
            color: #fff;
            background-color: transparent;
        }

        .socials--dark .social-facebook:hover,
        .socials--dark .social-facebook:focus {
            color: #39599f;
        }

        .socials--dark .social-twitter:hover,
        .socials--dark .social-twitter:focus {
            color: #55acee;
        }

        .socials--dark .social-youtube:hover,
        .socials--dark .social-youtube:focus {
            color: #c61d23;
        }

        .socials--dark .social-instagram:hover,
        .socials--dark .social-instagram:focus {
            color: #e1306c;
        }

        .socials--medium a {
            height: 40px;
            width: 40px;
            line-height: 40px;
            font-size: 16px;
        }

        .socials--nav a {
            width: 25px;
            line-height: 46px;
            font-size: 23px;
        }

        .socials--rounded a {
            border-radius: 50%;
        }

        .social {
            display: inline-block;
            line-height: 32px;
            width: 32px;
            height: 32px;
            color: #fff;
            text-align: center;
            margin-right: 8px;
            margin-bottom: 8px;
            font-size: 13px;
            -webkit-transition: all 0.1s ease-in-out;
            transition: all 0.1s ease-in-out;
        }

        .social:hover,
        .social:focus {
            color: #fff;
        }

        .social:last-child {
            margin-right: 0;
        }

        .social-facebook {
            background-color: #39599f;
        }

        .social-facebook:hover {
            background-color: #324e8c;
            color: #fff;
        }

        .social-twitter {
            background-color: #000;
        }

        .social-twitter:hover {
            background-color: #1c1c1c;
            color: #fff;
        }

        .social-youtube {
            background-color: #c61d23;
        }

        .social-youtube:hover {
            background-color: #b01a1f;
            color: #fff;
        }

        .social-instagram {
            background-color: #e1306c;
        }

        .social-instagram:hover {
            background-color: #d81f5e;
            color: #fff;
        }

        .social-whatsapp {
            background-color: #25d366;
        }

        .social-whatsapp:hover {
            background-color: #1db153;
            color: #fff;
        }

        .social-telegram {
            background-color: #089be4;
        }

        .social-telegram:hover {
            background-color: #0985c4;
            color: #fff;
        }

        .social-copy {
            background-color: #04a4a4;
        }

        .social-copy:hover {
            background-color: #048585;
            color: #fff;
        }

        .social-post {
            text-align: center;
            margin-top: 22px;
        }

        .trending-now {
            background-color: #fff;
            position: relative;
            overflow: hidden;
            margin-top: 24px;
            height: 36px;
            -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .trending-now__label {
            background-color: #2d95e3;
            font-family: "Source Sans Pro", sans-serif;
            font-weight: 700;
            display: inline-block;
            color: #fff;
            padding: 0 16px;
            line-height: 36px;
            height: 36px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-size: 14px;
            float: left;
        }

        .trending-now__label svg {
            color: #fff;
        }

        .trending-now__text {
            margin-left: 5px;
        }

        .trending-now--1 {
            -webkit-box-shadow: none;
            box-shadow: none;
            margin-top: 0;
        }

        .search-button {
            position: absolute;
            top: 0;
            right: 0;
            width: 46px;
            height: 46px;
            line-height: 46px;
            padding: 0;
            border: 0;
            vertical-align: middle;
            border-radius: 0 10px 10px 0;
        }

        .search-button i {
            font-size: 18px;
            margin: 0;
            top: 3px;
        }

        .nav {
            min-height: 48px;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            z-index: 120;
            position: relative;
            -webkit-transition: height 0.3s ease-in-out;
            transition: height 0.3s ease-in-out;
            /* Dropdowns (large screen) */
        }

        .nav__holder {
            background-color: #fff;
            -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav__menu {
            list-style: none;
        }

        .nav__menu {
            position: relative;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .nav__menu>li {
            position: relative;
        }

        .nav__menu>li:hover a:before {
            width: 100%;
        }

        .nav__menu>li>a {
            font-family: "Source Sans Pro", sans-serif;
            color: #171821;
            font-size: 14px;
            font-weight: 700;
            padding: 0 10px;
            display: block;
            position: relative;
            line-height: 48px;
        }

        .menu__lainnya>li>a {
            padding: 0;
        }

        .nav__menu>li>a:hover {
            color: #000;
        }

        .nav__menu>li>a:before {
            content: "";
            display: block;
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0 auto;
            background-color: #fff;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        @media only screen and (min-width: 992px) {
            .nav__menu>li {
                display: inline-block;
                text-align: center;
            }
        }

        /* Nav Style 1
-------------------------------------------------------*/

        .header {
            z-index: 3;
            position: relative;
        }

        .header__menu-list li {
            display: inline-block;
            padding: 0 10px;
            font-size: 14px;
            margin-right: 19px;
            position: static;
            vertical-align: middle;
            border-right: 1px solid #eff0f6;
            border-right-width: 1px;
            border-right-style: solid;
            border-right-color: rgb(239, 240, 246);
        }

        .header__menu-list a {
            color: #54555e;
        }

        /* Nav Style 2
-------------------------------------------------------*/

        /* Logo
-------------------------------------------------------*/
        .logo {
            line-height: 1;
        }

        /* Nav Flexbox
-------------------------------------------------------*/
        header .flex-parent {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        header .flex-child {
            -webkit-box-flex: 1;
            -ms-flex: 1 0 0px;
            flex: 1 0 0;
            line-height: 1;
        }

        /* Nav Right
-------------------------------------------------------*/
        .nav__right {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-left: auto;
        }

        @media only screen and (max-width: 991px) {
            .nav__right-item {
                margin-right: 0;
            }
        }

        .nav__right a:hover,
        .nav__right a:focus {
            color: #2d95e3;
        }

        /* Nav Search
-------------------------------------------------------*/
        .nav__search {
            margin-left: auto;
        }

        .nav__search-box {
            width: 300px;
            position: absolute;
            right: 0;
            top: 100%;
            padding: 15px 20px;
            background-color: #f7f7f7;
            display: none;
            -webkit-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #2cc38b;
            border-radius: 10px;
        }

        .nav__search-form {
            position: relative;
        }

        .nav__search-input {
            margin-bottom: 0;
            display: block;
            line-height: 40px;
            border-radius: 10px;
        }

        .nav__search-trigger {
            color: #171821;
            font-size: 23px;
            display: inline-block;
            width: 24px;
            height: 48px;
            line-height: 48px;
            text-align: center;
        }

        @media only screen and (max-width: 991px) {
            .nav__search-box {
                width: 100%;
            }
        }

        .nav__search:hover .nav__search-box {
            display: block;
            z-index: 99;
        }

        /*-------------------------------------------------------*/
        /* Top Bar
/*-------------------------------------------------------*/

        /*-------------------------------------------------------*/
        /* Nav Mobile Sidenav
/*-------------------------------------------------------*/
        .sidenav {
            background-color: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 320px;
            z-index: 121;
            /* overflow-y: auto; */
            -webkit-transition: transform 0.5s cubic-bezier(0.55, 0, 0.1, 1);
            -webkit-transition: -webkit-transform 0.5s cubic-bezier(0.55, 0, 0.1, 1);
            transition: -webkit-transform 0.5s cubic-bezier(0.55, 0, 0.1, 1);
            transition: transform 0.5s cubic-bezier(0.55, 0, 0.1, 1);
            transition: transform 0.5s cubic-bezier(0.55, 0, 0.1, 1),
                -webkit-transform 0.5s cubic-bezier(0.55, 0, 0.1, 1);
            -webkit-transform: translateX(-320px);
            transform: translateX(-320px);
        }

        .content-overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            bottom: 0;
            z-index: 121;
            visibility: hidden;
            opacity: 0;
            -webkit-transition: 0.3s cubic-bezier(0.16, 0.36, 0, 0.98);
            transition: 0.3s cubic-bezier(0.16, 0.36, 0, 0.98);
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Nav Icon Toggle
-------------------------------------------------------*/
        /* Aturan CSS untuk tampilan dekstop (lebar layar > 767px) */
        .nav-icon-toggle {
            padding: 0;
            display: inline-block;
            cursor: pointer;
            -webkit-transition: 0.15s linear;
            transition: 0.15s linear;
            font: inherit;
            color: inherit;
            text-transform: none;
            background-color: transparent;
            border: 0;
            margin-right: 20px;
            overflow: visible;
        }

        /* Aturan CSS untuk tampilan mobile (lebar layar <= 767px) */
        @media (max-width: 767px) {
            .nav-icon-toggle {
                padding: 0;
                display: inline-block;
                cursor: pointer;
                -webkit-transition: 0.15s linear;
                transition: 0.15s linear;
                font: inherit;
                color: inherit;
                text-transform: none;
                background-color: transparent;
                border: 0;
                margin-right: 20px;
                overflow: visible;
            }

            .nav-icon-toggle:focus {
                outline: none;
            }

            .nav-icon-toggle__box {
                width: 18px;
                height: 20px;
                position: relative;
                display: block;
            }

            .nav-icon-toggle__inner {
                display: block;
                top: 50%;
                margin-top: -1px;
                margin-left: 3px;
                width: 15px;
            }

            .nav-icon-toggle__inner,
            .nav-icon-toggle__inner:before,
            .nav-icon-toggle__inner:after {
                height: 2px;
                background-color: #171821;
                position: absolute;
                -webkit-transition: 0.2s all;
                transition: 0.2s all;
            }

            .nav-icon-toggle:hover .nav-icon-toggle__inner,
            .nav-icon-toggle:hover .nav-icon-toggle__inner:before,
            .nav-icon-toggle:hover .nav-icon-toggle__inner:after {
                background-color: #2d95e3;
            }

            .nav-icon-toggle__inner:before,
            .nav-icon-toggle__inner:after {
                content: "";
                display: block;
                margin-left: -3px;
            }

            .nav-icon-toggle__inner:before {
                top: -6px;
                width: 18px;
            }

            .nav-icon-toggle__inner:after {
                bottom: -6px;
                width: 18px;
            }
        }

        /* Sidenav Menu
-------------------------------------------------------*/
        .sidenav__menu-container {
            margin-top: 52px;
        }

        .sidenav__menu li {
            position: relative;
            border-bottom: 1px solid #e3e4e8;
            font-size: 14px;
        }

        .sidenav__menu li:last-child {
            border-bottom: 0;
        }

        .sidenav__menu-url {
            width: 100%;
            display: block;
            color: #54555e;
            padding: 12px 22px;
            font-family: Poppins, sans-serif;
            font-size: 15px;
            font-weight: 600;
            -webkit-transition: background 0.3s ease;
            transition: background 0.3s ease;
        }

        .sidenav__menu-url:hover,
        .sidenav__menu-url:focus {
            color: #2d95e3;
        }

        .sidenav__close {
            position: absolute;
            right: 15px;
            top: 15px;
        }

        .sidenav__close-button {
            padding: 0;
            background: transparent;
            border: 0;
            color: #171821;
            width: 24px;
            height: 24px;
        }

        .sidenav__close-button:hover {
            color: #2d95e3;
        }

        .sidenav__close-icon {
            font-size: 22px;
            line-height: 24px;
        }

        /* Sidenav Socials
-------------------------------------------------------*/
        .sidenav__socials {
            padding: 0 22px;
            margin-top: 20px;
        }

        /* Sticky Nav
-------------------------------------------------------*/
        .nav--sticky {
            width: 100%;
            height: 48px;
            transition: all 0.3s ease-in-out;
            background-color: transparent;
            position: relative;
        }

        /* Colored Nav
-------------------------------------------------------*/
        .nav--colored .nav__holder {
            background-color: #2cc38b;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .nav--colored .nav__menu>li>a,
        .nav--colored .nav__search-trigger,
        .nav--colored .nav__right a:hover,
        .nav--colored .nav__right a:focus {
            color: #fff;
        }

        .nav--colored .nav__menu>li>a:hover {
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            color: #000;
        }

        @media only screen and (max-width: 480px) {

            .nav--colored .nav__menu>li>a,
            .nav--colored .nav__menu>li>a:hover,
            .nav--colored .nav__search-trigger,
            .nav--colored .nav__right a:hover,
            .nav--colored .nav__right a:focus {
                color: #2cc38b;
            }
        }

        .nav--colored .nav-icon-toggle__inner,
        .nav--colored .nav-icon-toggle__inner:before,
        .nav--colored .nav-icon-toggle__inner:after,
        .nav--colored .nav-icon-toggle:hover .nav-icon-toggle__inner,
        .nav--colored .nav-icon-toggle:hover .nav-icon-toggle__inner:before,
        .nav--colored .nav-icon-toggle:hover .nav-icon-toggle__inner:after {
            background-color: #2cc38b;
        }

        /* Go to Top
-------------------------------------------------------*/
        #back-to-top {
            display: block;
            z-index: 100;
            width: 34px;
            height: 34px;
            text-align: center;
            font-size: 12px;
            position: fixed;
            bottom: -34px;
            right: 20px;
            line-height: 32px;
            background-color: rgba(23, 24, 33, 0.5);
            -webkit-box-shadow: 1px 1.732px 12px 0px rgba(0, 0, 0, 0.03);
            box-shadow: 1px 1.732px 12px 0px rgba(0, 0, 0, 0.03);
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            text-decoration: none;
        }

        #back-to-top i {
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        #back-to-top a {
            display: block;
            color: #fff;
        }

        #back-to-top:hover {
            background-color: #2d95e3;
            border-color: transparent;
        }

        #back-to-top:hover i {
            color: #fff;
        }

        @media only screen and (max-width: 991px) {

            .logo {
                position: absolute;
                left: 50%;
                top: 50%;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                height: 48px;
                line-height: 48px;
                text-align: center;
            }
        }

        .style-politics {
            font-family: Poppins, sans-serif;
        }

        .style-politics .nav__menu>li>a,
        .style-politics .btn,
        .style-politics .sidenav__menu-url,
        .style-politics .trending-now__label {
            font-family: Poppins, sans-serif;
        }

        .nav__right a:hover,
        .nav__right a:focus,
        .nav__menu>li>a:hover,
        .newsticker__item-url:hover,
        .newsticker__item-url:focus,
        .sidenav__menu-url:hover,
        .sidenav__menu-url:focus,
        .sidenav__close-button:hover,
        .header__menu-list a:hover,
        .header__menu-list a:focus,
        .footer a:not(.social):hover {
            color: #2cc38b;
        }

        .btn-color,
        .trending-now__label,
        .nav--colored .nav__holder,
        .nav-icon-toggle:hover .nav-icon-toggle__inner,
        .nav-icon-toggle:hover .nav-icon-toggle__inner:before,
        .nav-icon-toggle:hover .nav-icon-toggle__inner:after,
        #back-to-top:hover {
            background-color: #2cc38b;
        }

        input:focus {
            border-color: #2cc38b;
        }

        /* Media queries untuk responsif layout */
        @media screen and (max-width: 800px) {

            aside,
            article {
                float: none;
                width: 100%;
            }
        }

        .top-header {
            display: flex;
            height: 85px;
            flex-wrap: nowrap;
            align-content: center;
            flex-direction: row;
        }

        /* custom */
        header {
            background-color: #fff;
            color: #2cc38b;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5em;
        }

        nav {
            align-items: center;
        }

        .menu {
            list-style: none;
            display: flex;
        }

        .menu li {
            margin: 0 15px;
        }

        .menu a {
            text-decoration: none;
            color: #2cc38b;
        }

        .menu-toggle {
            cursor: pointer;
            display: none;
            flex-direction: column;
            padding: 5px;
        }

        .menu-toggle span {
            background-color: #2cc38b;
            height: 4px;
            width: 25px;
            margin: 2px 0;
            display: block;
        }

        @media (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 60px;
                left: 0;
                background-color: #fff;
                padding: 10px;
                z-index: 10;
            }

            .menu.active {
                display: flex;
            }

            .menu li {
                margin: 6px 0;
            }

            .menu-toggle {
                display: flex;
            }
        }

        .sidenav--is-open {
            -webkit-transform: translateX(0);
            transform: translateX(0);
        }

        @keyframes marquee {
            0% {
                transform: translateX(200%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .marquee-container {
            white-space: nowrap;
            overflow: hidden;
            position: relative;
            width: 100%;
            /* Sesuaikan lebar div sesuai kebutuhan */
        }

        .marquee-content {
            display: inline-block;
            animation-duration: 20s;
            animation: tickerh linear 35s infinite;
        }

        /* lanjutan sandi */

        .blog__content {
            width: 100%;
        }

        .title-single-post {
            letter-spacing: normal;
            line-height: 1.2;
            color: #000;
            text-align: center;
            font-weight: 700;
            font-size: 26px;
        }

        .col-lg-8 {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .entry__meta-holder {
            text-align: center;
            margin-top: 16px;
        }

        .entry__meta-holder .entry__meta {
            margin-top: 0;
        }

        .entry__meta li {
            display: inline-block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .entry__meta-author:after {
            content: "-";
            display: inline-block;
            margin: 0 3px;
        }

        h1 {
            font-family: Poppins, sans-serif;
        }

        *,
        :after,
        :before {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .image-single-post .photo {
            margin-bottom: 0;
        }

        .image-single-post img {
            border-radius: 15px;
        }

        .image-single-post img {
            height: 260px;
            width: 100%;
        }

        body img {
            border: none;
            max-width: 100%;
            -webkit-user-select: none;
            -moz-user-select: none;
            -o-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .photo__caption {
            margin-top: 0;
            padding: 10px 0;
            text-align: left;
            font-size: 12px;
            font-weight: 400;
            color: #999;
            line-height: 1.5;
            margin-left: 15px;
        }

        .read__content {
            padding: 0 0 20px;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5;
            color: #000;
        }

        .read__content p {
            text-align: left;
        }

        .style-politics {
            font-family: Poppins, sans-serif;
        }

        img {
            max-width: 100%;
            height: auto;
            vertical-align: top;
        }

        p {
            font-size: 16px;
            color: #000;
            font-weight: normal;
            line-height: 26px;
            margin: 0 0 10px;
            margin-top: 0;
            margin-bottom: 1rem;
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
        }

        .breadcrumbs {
            margin-top: 24px;
            margin-bottom: 24px;
        }

        .breadcrumbs__item {
            font-weight: 700;
            display: inline-block;
            font-size: 18px;
            background-color: #eff0f6;
            padding: 10px;
            border-radius: 10px;
        }

        .breadcrumbs__item:last-child:after {
            display: none;
        }

        .breadcrumbs__url {
            color: #333439;
        }

        .thumb {
            margin: 17px -15px;
        }

        .halaman {
            padding: 5px 0;
            position: relative;
            display: flex;
        }

        .halaman__teaser {
            padding: 15px 0 0;
            width: 80px;
            font-size: 16px;
            font-weight: 700;
        }

        .halaman__wrap {
            position: relative;
            align-items: center;
        }

        .halaman__item {
            display: inline-block;
            margin: 5px 2px;
            vertical-align: middle;
        }

        .pagination__page--current,
        .pagination__page:not(span):hover {
            background-color: #2cc38b;
        }

        .entry__article a:hover {
            color: #000;
        }

        .halaman__all a:hover {
            color: #fff;
        }

        .halaman__selanjutnya:hover {
            background: #2cc38b;
        }

        .entry__article a {
            color: #2cc38b;
            text-decoration: none;
        }

        .pagination__page {
            font-size: 15px;
            border-radius: 50px;
            display: inline-block;
            border: 1px solid #2cc38b;
            width: 32px;
            height: 32px;
            line-height: 32px;
            margin: 5px 1px;
            text-align: center;
            color: #171821;
            background-color: #fff;
            vertical-align: middle;
        }

        .halaman__all {
            float: right;
            margin: 5px 2px;
            padding-top: 5px;
        }

        .halaman__all a {
            color: #000;
        }

        .halaman__selanjutnya {
            padding: 7px 11px;
            display: block;
            line-height: 1;
            border-radius: 20px;
            background: #d2d2d2;
            font-size: 18px;
            font-weight: 400;
        }

        .halaman__item .pagination__page--current {
            color: #fff;
            background-color: #2cc38b;
        }

        .pagination__page--current {
            background-color: #2cc38b;
            color: #fff;
            border-color: transparent;
        }

        /* google news */
        .croslink {
            margin: 15px 0 27px;
            position: relative;
        }

        .croslink a {
            color: #fff;
            border-radius: 20px;
            border: solid 5px #e4e4e4;
            background: rgb(14, 147, 97);
            background: linear-gradient(50deg, rgba(14, 147, 97, 0.756827731092437) 0%, rgba(44, 195, 139, 0.6755952380952381) 100%);
            display: block;
            padding: 13px 17px;
            font-size: 17px;
            font-weight: 400;
            line-height: 1.4;
            padding-right: 45px;
        }

        @media only screen and (max-width: 767px) {
            .croslink a {
                padding: 13px 24px;
                font-size: 12px;
                padding-right: 0;
            }
        }

        .read__content strong {
            font-weight: 700;
        }

        .editor__text span {
            font-weight: 600;
        }

        .entry__tags {
            margin-top: 30px;
        }

        .entry__tags i {
            font-size: 12px;
        }

        .entry__tags-label {
            color: #171821;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-weight: 700;
            font-size: 14px;
            display: inline-block;
            margin-right: 8px;
            margin-left: 3px;
        }

        .style-politics .entry__tags a {
            font-family: Poppins, sans-serif;
        }

        .entry__tags a {
            float: none;
            color: #2cc38b;
        }

        .entry__tags a {
            padding: 6px 10px;
            line-height: 1;
            margin: 0 8px 8px 0;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            background-color: #f7f7f7;
            font-family: "Source Sans Pro", sans-serif;
            display: inline-block;
        }

        .entry__tags a:hover {
            background-color: #2cc38b;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            border-color: transparent;
            color: #fff;
        }

        .berita-terkini-title {
            border-top: none;
            position: relative;
            z-index: 2;
            padding: 20px 0 15px;
            line-height: 1.4;
            font-weight: 600;
        }

        .berita-terkini-title h2 {
            color: #333;
            text-transform: capitalize;
            position: relative;
            z-index: 200;
            padding-left: 15px;
            padding-right: 5px;
        }

        .berita-terkini-title h2:before {
            content: "";
            display: block;
            position: absolute;
            width: 4px;
            height: calc(100% + 2px);
            top: -1px;
            left: -1px;
            background-color: #2cc38b;
        }

        .berita-terkini-title:after {
            content: "";
            vertical-align: middle;
            width: 20%;
            height: 4px;
            position: relative;
        }

        .ui-tags:before {
            content: '\e808';
        }

        .flex-container {
            display: flex;
            flex-direction: column;
        }

        .bottom-widget {
            display: flex;
            flex-direction: column;
        }

        .bootom-widget {
            display: flex;
            flex-direction: column;
        }

        .berita-terkini-container {
            display: flex;
            flex-direction: column;
        }

        .berita-terkini {
            display: flex;
            flex-direction: column;
        }

        .berita-terkini-items {
            display: flex;
            margin: 6px;
            margin-bottom: 12px;
        }

        .bt__date {
            color: #5a5a5a
        }

        .berita-terkini-img {
            margin-right: 18px;
        }

        .bottom-widget {
            padding: 10px;
        }

        /* Parallax */
        .parallax {
            height: 350px;
            width: 100%;
            background-attachment: fixed;
            background-position: 23vw 10vh;
            background-repeat: no-repeat;
            background-size: auto;
            overflow: hidden;
            position: relative;
        }

        @media only screen and (max-width: 1440px) {
            .parallax {
                height: 350px;
                width: 100%;
                background-attachment: fixed;
                background-position: 18% 27vh;
                background-repeat: no-repeat;
                background-size: auto;
                overflow: hidden;
                position: relative;
            }
        }

        @media only screen and (max-width: 766px) {
            .parallax {
                background-position: cover;
                margin-left: 0px;
                background-size: cover;
            }
        }

        @media only screen and (max-width: 480px) {
            .parallax {
                background-position: left;
                margin-left: 0px;
                background-size: 100%;

            }
        }
    </style>
</head>

<body class="style-politics">
    <!-- Google Tag Manager -->
    <amp-analytics config="https://www.googletagmanager.com/amp.json?id=GTM-NGZBR9F" data-credentials="include" />
    @php
        $jsonLDData = [
            'vars' => [
                'published_date' => $post->created_at,
                'rubrik' => $post->rubrik->rubrik_name,
                'penulis' => $post->author->display_name,
                'editor' => '',
                'id' => $post->post_id,
                'source' => '',
                'topic' => '',
                'tag' => $post->tags,
                'penulis_id' => $post->author->author_id,
                'editor_id' => $post->author->editor_id,
            ],
        ];
        $jsonLD = json_encode($jsonLDData, JSON_PRETTY_PRINT);
        echo '<script type="application/json">' . $jsonLD . '</script>';
    @endphp

    </amp-analytics>

    <!-- Google Ads -->
    <amp-auto-ads type="adsense" data-ad-client="ca-pub-7210727750015750"></amp-auto-ads>

    <div class="content-overlay"></div>
    <main class="main oh" id="main"style="background: #fff">
        <!-- Trending Now -->
        @if ($breakingNews->count() > 0)
            <div style="position: sticky; height: 30px; display:flex; align-items:center;">
                <div class="col-2 trending-now__label" style="height:100%">
                    <svg fill="#fff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                        viewBox="0 0 96.258 96.258" xml:space="preserve">
                        <g>
                            <path
                                d="M75.225,37.515c-0.357-0.616-1.017-0.995-1.729-0.995h-21.03L67.177,2.8c0.271-0.618,0.21-1.331-0.16-1.896 S66.018,0,65.344,0H41.976c-0.848,0-1.604,0.535-1.886,1.334L20.876,55.762c-0.216,0.612-0.122,1.291,0.253,1.821 s0.984,0.845,1.633,0.845h22.636L34.391,93.662c-0.189,0.607-0.079,1.269,0.298,1.781s0.975,0.814,1.611,0.814h5.449 c0.719,0,1.382-0.386,1.738-1.01L75.234,39.51C75.587,38.891,75.583,38.131,75.225,37.515z" />
                        </g>
                    </svg>
                </div>
                <div class="marquee-container">
                    <div class="marquee-content">
                        @foreach ($breakingNews as $news)
                            <a href="{{ route('singlePost', [
                                'rubrik' => $news->post->rubrik->rubrik_name,
                                'post_id' => $news->post->post_id,
                                'slug' => $news->post->slug,
                            ]) }}"
                                class="newsticker__item-url">{{ $news->title }}</a>
                        @endforeach
                    </div>
                </div>

            </div>

        @endif
        <!-- Sidenav -->
        <header class="sidenav" id="sidenav" style="display: flex; align-item: strech; flex-direction: column; ">
            <!-- Side Menu Button -->
            <nav style="margin: 5px 27px 0 0; width:100%; display: flex; flex-direction: column; align-items: end;">
                <div class="menu-toggle" tabindex="0" role="button"
                    on="tap:sidenav.toggleClass(class='sidenav--is-open')">
                    Close
                </div>
            </nav>

            <!-- Nav -->
            <nav class="sidenav__menu-container" style="margin-top:20px; width: 100%; overflow: scroll;">
                @php
                    $rubriks = Rubrik::get();
                @endphp
                <ul class="sidenav__menu" role="menubar">
                    <!-- Categories -->
                    <li>
                        <a href="{{ route('gallery') }}" class="sidenav__menu-url">Gallery</a>
                    </li>
                    @foreach ($rubriks as $rubrik)
                        <li>
                            <a href="{{ route('category', ['rubrik_name' => $rubrik->rubrik_name]) }}"
                                class="sidenav__menu-url">{{ $rubrik->rubrik_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </header> <!-- end sidenav -->

        <!-- Header -->
        <header class="header d-lg-block d-none">
            <div class="container">
                <div style="height: 85px; justify-content: space-between; align-items: center; display:flex">
                    <div class="flex-item" style="">
                        <!-- Date -->
                        <nav class="flex-child header__menu d-none d-lg-block">
                            <ul class="header__menu-list">
                                <li><a>{{ Carbon::now()->locale('id_ID')->isoFormat('dddd, DD MMMM YYYY') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="flex-item">
                        <!-- Logo -->
                        <amp-img src="{{ Storage::url('logo/') . get_setting('logo_web') }}" alt="logo"
                            height="50" width="250">
                    </div>
                    <div class="flex-item" style="">
                        <div class="d-flex" style="gap: 20px;position: relative;">
                            <div class="socials socials--nobase socials--nav">
                                <a class="social social-facebook" href="https://web.facebook.com/gemasulawesi/"
                                    target="_blank" aria-label="facebook">
                                    <amp-img src="{{ url('assets/frontend/img/icons/') }}/facebook.png"
                                        width="20" height="20"></amp-img>

                                </a>
                                <a class="social social-twitter" href="https://twitter.com/gemasulawesi"
                                    target="_blank" aria-label="twitter">
                                    <amp-img src="{{ url('assets/frontend/img/icons/') }}/twitter.png" width="20"
                                        height="20"></amp-img>

                                </a>
                                <a class="social social-youtube"
                                    href="https://www.youtube.com/channel/UC33j0RRE1wtX3ZKmyca0Mtg" target="_blank"
                                    aria-label="youtube">
                                    <amp-img src="{{ url('assets/frontend/img/icons/') }}/youtube.png" width="20"
                                        height="20"></amp-img>
                                </a>
                                <a class="social social-instagram" href="https://www.instagram.com/gema.parimo/"
                                    target="_blank" aria-label="instagram">
                                    <amp-img src="{{ url('assets/frontend/img/icons/') }}/instagram.png"
                                        width="20" height="20"></amp-img>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </header> <!-- end header -->
        <!-- Navigation -->
        <header class="" id="scroll">
            <div class="nav__holder nav--sticky">
                <div class="container relative">
                    <div class="flex-parent">
                        <div class="flex-parent">
                            <div class="nav__home">
                                <a href="{{ url('/') }}" title="Home">
                                    Home
                                </a>
                            </div>
                            <!-- Side Menu Button -->
                            <nav style="margin-top: 5px">
                                <div class="menu-toggle" tabindex="0" role="button"
                                    on="tap:sidenav.toggleClass(class='sidenav--is-open')">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </nav>
                        </div>
                        <!-- Nav-wrap -->
                        <nav class="flex-child d-none d-lg-block" style="overflow: scroll; overflow-y: hidden;">
                            <ul class="nav__menu">
                                @foreach ($rubriks->take(get_setting('count_rubrik')) as $rubrik)
                                    <li>
                                        <a href="{{ route('category', ['rubrik_name' => $rubrik->rubrik_name]) }}"
                                            class="link-nav__menu"
                                            style="white-space: nowrap;">{{ $rubrik->rubrik_name }}</a>
                                    </li>
                                @endforeach

                                <li>
                                    <a href="{{ route('gallery') }}" style="white-space: nowrap;">Gallery</a>
                                </li>
                            </ul>
                            <!-- end menu -->
                        </nav>

                        <!-- Logo Mobile -->
                        <a href="{{ url('') }}" class="logo logo-mobile d-lg-none"
                            style="height: 100%; margin-top: 5px;">
                            <amp-img class="logo__img" style="" height="30" width="120"
                                src="{{ Storage::url('logo/') . get_setting('logo_web') }}" alt="logo">
                        </a>
                    </div> <!-- end flex-parent -->

                </div>
            </div>



        </header> <!-- end navigation -->

        <!-- Ad Banner 728 -->
        {{-- <div class="container">
            <div class="text-center ads__banner">
                <a href="#">
                    <amp-img width="728" height="230"
                        src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg" alt="">
                </a>
            </div>
        </div> --}}

        {{-- konten --}}
        @yield('content')
        <amp-ad width="100vw" height="320" type="adsense" data-ad-client="ca-pub-7210727750015750"
            {{-- data-ad-slot="7046626912" --}} data-auto-format="rspv" data-full-width>
            <div overflow></div>
        </amp-ad>
        <footer class="footer">
            <div class="container">
                <div class="footer__widgets">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="footer__contact">
                                <p>{{ get_setting('alamat') }}<br>
                                </p>
                                <p>
                                    Email: {{ get_setting('email') }}<br>
                                    Phone: {{ get_setting('no_hp') }}
                                </p>
                            </div>
                            {{-- Social --}}

                            <div class="flex-item" style="margin:0px auto;">
                                <div class="d-flex" style="gap: 20px;position: relative; margin:0px auto;">
                                    <div class="socials socials--nobase socials--nav" style="margin:0px auto;">
                                        <a class="social social-facebook"
                                            href="https://web.facebook.com/gemasulawesi/" target="_blank"
                                            aria-label="facebook">
                                            <amp-img src="{{ url('assets/frontend/img/icons/') }}/facebook.png"
                                                width="20" height="20"></amp-img>

                                        </a>
                                        <a class="social social-twitter" href="https://twitter.com/gemasulawesi"
                                            target="_blank" aria-label="twitter">
                                            <amp-img src="{{ url('assets/frontend/img/icons/') }}/twitter.png"
                                                width="20" height="20"></amp-img>

                                        </a>
                                        <a class="social social-youtube"
                                            href="https://www.youtube.com/channel/UC33j0RRE1wtX3ZKmyca0Mtg"
                                            target="_blank" aria-label="youtube">
                                            <amp-img src="{{ url('assets/frontend/img/icons/') }}/youtube.png"
                                                width="20" height="20"></amp-img>
                                        </a>
                                        <a class="social social-instagram"
                                            href="https://www.instagram.com/gema.parimo/" target="_blank"
                                            aria-label="instagram">
                                            <amp-img src="{{ url('assets/frontend/img/icons/') }}/instagram.png"
                                                width="20" height="20"></amp-img>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{-- ./Social --}}
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer__menu">
                                <div class="footer__item">
                                    <a href="" class="footer__link" rel="noreferred">Tentang Kami</a>
                                </div>
                                <div class="footer__item">
                                    <a href="" class="footer__link" rel="noreferred">Kode Etik</a>
                                </div>
                                <div class="footer__item">
                                    <a href="" class="footer__link" rel="noreferred">Redaksi</a>
                                </div>
                                <div class="footer__item">
                                    <a href="" class="footer__link" rel="noreferred">Kode Perilaku
                                        Pers</a>
                                </div>
                                <div class="footer__item">
                                    <a href="" class="footer__link" rel="noreferred">Pedoman Media
                                        Siber</a>
                                </div>
                                <div class="footer__item">
                                    <a href="" class="footer__link" rel="noreferred">Perlindungan Data
                                        Pengguna</a>
                                </div>
                                <div class="footer__item">
                                    <a href="" class="footer__link" rel="noreferred">Lowongan Kerja</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="footer__verifikasi" style="display: flex; align-items:center;">
                                <amp-img class="ls-is-cached lazyloaded"
                                    src="{{ url('assets/frontend') }}/img/centang-biru.png" width="40"
                                    height="40" alt="PRMN Centang Biru" data-loaded="true">
                                </amp-img>
                                <p>
                                    <b>Telah Terverifikasi Dewan Pers</b>
                                    <b>Sertifikat Nomor <br><i>{{ get_setting('no_sertification') }}</i></b>
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

</body>

</html>
