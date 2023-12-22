<!DOCTYPE html>
<html lang="en">
@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    $breakingNews = App\Models\Breakingnews::get();
    use App\Models\Rubrik;
    use App\Models\Navigation;

    $baseUrl = URL::to('');
@endphp

<head>
    @php
        if (request()->is('search')) {
            $metaTitle = 'Gema Sulawesi Search';
            $metaDeskripsi = 'Gema Sulawesi Search';
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        } elseif (request()->is('indeks-berita')) {
            $metaTitle = 'Gema Sulawesi Indeks';
            $metaDeskripsi = 'Gema Sulawesi Indeks';
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        } elseif (request()->is('topik-khusus/detail/*')) {
            $metaTitle = $topik->topic_name;
            $metaDeskripsi = $topik->topic_description;
            $metaImage = get_post_thumbnail($topik->topic_id);
        } elseif (request()->is('tentang-kami')) {
            $metaTitle = 'Tentang Kami';
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        } elseif (request()->is('kode-etik')) {
            $metaTitle = 'Kode Etik';
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        } elseif (request()->is('redaksi')) {
            $metaTitle = 'Redaksi';
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        } elseif (request()->is('kode-perilaku-pers')) {
            $metaTitle = 'Redaksi';
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        } elseif (request()->is('pedoman-media-siber')) {
            $metaTitle = 'Pedoman Media Siber';
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        } elseif (request()->is('perlindungan-data-pengguna')) {
            $metaTitle = 'Perlindungan Data Pengguna';
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        } elseif (request()->is('lowongan-kerja')) {
            $metaTitle = 'Lowongan Kerja';
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        } elseif (request()->is('extra/*')) {
            $extra_key = $extra->key;
            $extra_label = Str::replace('-', ' ', explode('--', $extra->key)[1]);
            $extra_label = Str::ucfirst($extra_label);
            $metaTitle = $extra_label;
            $metaDeskripsi = get_setting('meta_google');
            $metaImage = Storage::url('logo/') . get_setting('logo_web');
        }
        $subTitle = get_setting('sub_title');
    @endphp

    <!-- s: open graph -->
    <title itemprop="name">{{ $metaTitle . ' - ' . $subTitle }}</title>
    <link href="{{ $metaImage }}" itemprop="image" />
    <link href="{{ Storage::url('favicon/') . get_setting('favicon') }}" rel="icon" type="image/ico" />
    <link rel="apple-touch-icon-precomposed" href="{{ Storage::url('favicon/') . get_setting('favicon') }}">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="title" content="@yield('title')" />
    <meta name="description" content="{{ $metaDeskripsi }}" itemprop="description">
    <meta name="thumbnailUrl" content="{{ $metaImage }}" itemprop="thumbnailUrl" />
    <meta name="author" content="www.gemasulawesi.com" itemprop="author">
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
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $metaTitle . ' - ' . $subTitle }}" />
    <meta property="og:description" content="{{ $metaDeskripsi }}" />
    <meta property="og:site_name" content="www.gemasulawesi.com" />
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

    @php
        if (request()->is('search')) {
            echo '<script>
                dataLayer = [{
                    "breadcrumb_detail": "Section Page",
                    "content_category": "Gema Sulawesi Search"
                }];
            </script>';
        } elseif (request()->is('indeks-berita')) {
            echo '<script>
                dataLayer = [{
                    "breadcrumb_detail": "Section Page",
                    "content_category": "Gema Sulawesi Indeks"
                }];
            </script>';
        } elseif (request()->is('topik-khusus/detail/*')) {
            echo '<script>
                dataLayer = [{
                    "breadcrumb_detail": "Section Page",
                    "content_category": "'.$topik->topic_name.'"
                }];
            </script>';
        } elseif (request()->is('tentang-kami')) {
            echo '<script>
                dataLayer = [{
                    "breadcrumb_detail": "Section Page",
                    "content_category": "Tentang Kami"
                }];
            </script>';
        } elseif (request()->is('kode-etik')) {
            echo '<script>
                dataLayer = [{
                    "breadcrumb_detail": "Section Page",
                    "content_category": "Kode Etik"
                }];
            </script>';
        } elseif (request()->is('redaksi')) {
            echo '<script>
                dataLayer = [{
                    "breadcrumb_detail": "Section Page",
                    "content_category": "Redaksi"
                }];
            </script>';
        } elseif (request()->is('kode-perilaku-pers')) {
            echo '<script>
                dataLayer = [{
                    "breadcrumb_detail": "Section Page",
                    "content_category": "Kode Perilaku Pers"
                }];
            </script>';
        } elseif (request()->is('pedoman-media-siber')) {
            echo '<script>
                dataLayer = [{
                    "breadcrumb_detail": "Section Page",
                    "content_category": "Pedoman media siber"
                }];
            </script>';
        }
    @endphp

    {{-- breadcrumb --}}
    @php
        $jsonLDData = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'url' => 'https://www.gemasulawesi.com/',
            'potentialAction' => [
                [
                    '@type' => 'SearchAction',
                    'target' => 'https://www.gemasulawesi.com/search?q={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
        ];

        $jsonLD = json_encode($jsonLDData, JSON_PRETTY_PRINT);
        echo '<script type="application/ld+json">' . $jsonLD . '</script>';
    @endphp

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

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet'>
    <!-- Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/font-icons.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/style.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/custom.css" />
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/colors/tosca.css" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ Storage::url('favicon/') . get_setting('favicon') }}">
    <link rel="icon" href="{{ Storage::url('favicon/') . get_setting('favicon') }}" sizes="32x32" />
    <link rel="icon" href="{{ Storage::url('favicon/') . get_setting('favicon') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ Storage::url('favicon/') . get_setting('favicon') }}" />
    <meta name="msapplication-TileImage" content="{{ Storage::url('favicon/') . get_setting('favicon') }}" />

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Lazyload (must be placed in head in order to work) -->
    <script src="{{ url('assets/frontend') }}/js/lazysizes.min.js"></script>

    {{-- rangedate --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- jquery js --}}
    <script src="{{ url('assets/frontend') }}/js/jquery.min.js"></script>

</head>

<body class="home style-politics ">
    <!-- Bg Overlay -->
    <div class="content-overlay"></div>

    <!-- Sidenav -->
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
                                <a target="_self" href="{{ url('/') }}">
                                    <img class=" ls-is-cached lazyloaded"
                                        data-src="{{ Storage::url('logo/') . get_setting('logo_web') }}"
                                        src="{{ Storage::url('logo/') . get_setting('logo_web') }}"
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
                                    data-src="{{ url('assets/frontend') }}/img/centang-biru.png"
                                    src="{{ url('assets/frontend') }}/img/centang-biru.png" width="40"
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

        {{-- <div id="back-to-top">
            <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
        </div> --}}

    </main> <!-- end main-wrapper -->
    <!-- jQuery Scripts -->
    <script src="{{ url('assets/frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/easing.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    {{-- <script src="{{ url('assets/frontend') }}/js/flickity.pkgd.min.js"></script> --}}
    {{-- <script src="{{ url('assets/frontend') }}/js/twitterFetcher_min.js"></script> --}}
    <script src="{{ url('assets/frontend') }}/js/modernizr.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/owl-carousel.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/jquery.sticky-kit.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/jquery.newsTicker.min.js"></script>
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
    <script>
        $(function() {
            var start = moment().subtract(6, 'days');
            var end = moment();
            // init date
            $('#reportrange span').html(start.format('DD MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
            $('#selectedStartDate').val(start.format('YYYY-MM-DD'));
            $('#selectedEndDate').val(end.format('YYYY-MM-DD'));

            function getParameterByName(name, url = window.location.href) {
                name = name.replace(/[\[\]]/g, '\\$&');
                var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }

            if (getParameterByName('start_date') != null) {
                console.log('has date')
                $('#reportrange span').html(moment(getParameterByName('start_date')).format('DD MMMM, YYYY') +
                    ' - ' + moment(getParameterByName('end_date')).format('D MMMM, YYYY'));
                $('#selectedStartDate').val(getParameterByName('start_date'));
                $('#selectedEndDate').val(getParameterByName('end_date'));
            }

            function cb(start, end) {
                console.log('Start Date:', start.format('YYYY-MM-DD'));
                console.log('End Date:', end.format('YYYY-MM-DD'));

                $('#reportrange span').html(start.format('DD MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                $('#selectedStartDate').val(start.format('YYYY-MM-DD'));
                $('#selectedEndDate').val(end.format('YYYY-MM-DD'));
                fetchData(); // Panggil fungsi fetchData saat tanggal berubah
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hari ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Hari yang lalu': [moment().subtract(6, 'days'), moment()],
                    'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                    'Sebulan yang lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(
                        1, 'month').endOf('month')]
                }
            }, cb);

            // Fungsi untuk mengirim permintaan AJAX
            function fetchData() {
                var startDate = $('#selectedStartDate').val();
                var endDate = $('#selectedEndDate').val();
                window.location.replace(window.location.origin + '/indeks-berita?start_date=' + startDate +
                    '&end_date=' + endDate)
            }
        });
    </script>

    <script>
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
</body>

</html>
