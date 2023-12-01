@extends('layouts.other')
@section('content')
    <div class="main-container container" id="main-container">
        <div class="social-post socials--medium socials--rounded">
            <a href="#" target="_blank" class="social social-facebook" id="share-facebook-top" aria-label="facebook"><i
                    class="fa-brands fa-facebook-f"></i></a>
            <a href="#" target="_blank" class="social social-twitter" id="share-twitter-top" aria-label="twitter"><i
                    class="fa-brands fa-x-twitter"></i></a>
            <a href="#" target="_blank" class="social social-whatsapp" id="share-whatsapp-top"
                aria-label="whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="#" target="_blank" class="social social-telegram" id="share-telegram-top"
                aria-label="telegram"><i class="fa-brands fa-telegram"></i></a>
            <a href="#" class="social social-copy" id="share-copy-top" aria-label="copy"><i
                    class="fa-solid fa-link"></i></a>
        </div>
        <article class="read__conten">
            @php
                $about = get_setting('code_pers');
            @endphp
            {!! $about !!}
        </article>
    </div>
@endsection
