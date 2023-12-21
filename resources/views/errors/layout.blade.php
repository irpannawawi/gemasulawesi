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
        $metaTitle = 'Halaman Tidak Ditemukan';
        $metaDeskripsi = 'Halaman Tidak Ditemukan';
        $metaImage = asset('assets/frontend/img');
        $type = 'website';
        $subTitle = get_setting('sub_title');
    @endphp

    <!-- s: open graph -->
    <title itemprop="name">@yield('title') - {{ $subTitle }}</title>
    <link href="{{ $metaImage }}/@yield('image')" itemprop="image" />
    <link href="{{ Storage::url('favicon/') . get_setting('favicon') }}" rel="icon" type="image/ico" />
    <link rel="apple-touch-icon-precomposed" href="{{ Storage::url('favicon/') . get_setting('favicon') }}">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="title" content="@yield('title') - {{ $subTitle }}" />
    <meta name="description" content="@yield('message')" itemprop="description">
    <meta name="thumbnailUrl" content="{{ $metaImage }}/@yield('image')" itemprop="thumbnailUrl" />
    <meta name="author" content="Gema Sulawesi" itemprop="author">
    <meta name="robots" content="index,follow" />
    <meta name="googlebot-news" content="index,follow" />
    <meta name="googlebot" content="index,follow" />
    <!-- E:tweeter card -->

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

    {{-- magnific --}}
    <link rel="{{ url('assets/frontend/css/magnific.css') }}">

    <!-- Lazyload (must be placed in head in order to work) -->
    <script src="{{ url('assets/frontend') }}/js/lazysizes.min.js"></script>
</head>

<body class="home style-politics ">
    <!-- Bg Overlay -->
    <div class="content-overlay"></div>
    <x-sidenav />



    <main class="main oh" id="main">

        <x-trending />

        <x-front-end-nav />

        <div class="pagenotfound">
            <div class="row">
                <div class="container">
                    <div class="col-12">
                        <div class="p404">
                            <div class="display-table">
                                <div class="display-center">
                                    <img src="<?= url('assets/frontend') ?>/img/@yield('image')" alt="404 Not Found"
                                        style="width: 40%">
                                    <div class="p404__content">
                                        @yield('code') @yield('message')
                                    </div>
                                    <a href="<?= url('/') ?>" class="p404__link">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                <a class="social social-twitter" href="https://{{ get_setting('x') }}" target="_blank"
                                    aria-label="twitter">
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
    <script src="{{ url('assets/frontend') }}/js/flickity.pkgd.min.js"></script>
    {{-- <script src="{{ url('assets/frontend') }}/js/twitterFetcher_min.js"></script> --}}
    <script src="{{ url('assets/frontend') }}/js/jquery.sticky-kit.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/jquery.newsTicker.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/modernizr.min.js"></script>
    <script src="{{ url('assets/frontend') }}/js/scripts.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

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
</body>

</html>
