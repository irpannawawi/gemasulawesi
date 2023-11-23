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
    
    <!-- s: open graph -->
    <title itemprop="name">www.Gemasulawesi.com</title>
    <link href="{{ url('assets/frontend/img') }}/cropped-favicon-32x32.png?v=892" rel="icon" type="image/ico" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('assets/frontend/img') }}/cropped-favicon-192x192.png?v=892">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />




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

<div class="main-container container" id="main-container">
    <div class="row">
        <section>
            <div class="container">
                <div class="text">
                    <h1>Page Not Found</h1>
                    <p>We can't seem to find the page you're looking for. Please check the URL for any typos.</p>
                    <div class="input-box">
                        <input type="text" placeholder="Search...">
                        <button><i class="fa-solid fa-search"></i></button>
                    </div>
                    <ul class="menu">
                        <li><a href="#">Go to Homepage</a></li>
                        <li><a href="#">Visit our Blog</a></li>
                        <li><a href="#">Contact support</a></li>
                    </ul>
                </div>
                <div><img class="image" src="errorimg.png" alt=""></div>
            </div>
        </section>
    </div>
</div>


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
                        <p>Jl Kampali, Kelurahan Kampal Kecamatan Parigi
                            Kabupaten Parigi moutong Provinsi Sulawesi tengah.<br>
                        </p>
                        <p>
                            Email: <br>
                            Phone:
                        </p>
                    </div>
                    <div class="social__footer socials--medium socials--rounded">
                        <a class="social social-facebook" href="https://web.facebook.com/gemasulawesi/"
                            target="_blank" aria-label="facebook">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a class="social social-twitter" href="https://twitter.com/gemasulawesi"
                            target="_blank" aria-label="twitter">
                            <i class="fa-brands fa-square-x-twitter"></i>
                        </a>
                        <a class="social social-youtube"
                            href="https://www.youtube.com/channel/UC33j0RRE1wtX3ZKmyca0Mtg" target="_blank"
                            aria-label="youtube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a class="social social-instagram" href="https://www.instagram.com/gema.parimo/"
                            target="_blank" aria-label="instagram">
                            <i class="fa-brands fa-square-instagram"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer__menu">
                        <div class="footer__item">
                            <a href="" class="footer__link" rel="”noreferred”">Tentang Kami</a>
                        </div>
                        <div class="footer__item">
                            <a href="" class="footer__link" rel="”noreferred”">Hubungi Kami</a>
                        </div>
                        <div class="footer__item">
                            <a href="" class="footer__link" rel="”noreferred”">Redaksi</a>
                        </div>
                        <div class="footer__item">
                            <a href="" class="footer__link" rel="”noreferred”">Kode Perilaku
                                Pers</a>
                        </div>
                        <div class="footer__item">
                            <a href="" class="footer__link" rel="”noreferred”">Pedoman Media
                                Siber</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="footer__verifikasi">
                        <img class=" ls-is-cached lazyloaded"
                            data-src="{{ url('assets/frontend') }}/img/centang-biru.png"
                            src="{{ url('assets/frontend') }}/img/centang-biru.png" width="40"
                            height="40" alt="PRMN Centang Biru" data-loaded="true">
                        <span>
                            <b>Telah Terverifikasi Dewan Pers</b>
                            <br>
                            <b>Sertifikat Nomor <i>1043/DP-Verifikasi/K/XII/2022</i></b>
                        </span>
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
