 @php
     use App\Models\Navigation;
     use Iluminate\Support\Carbon;
 @endphp
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
            $navs = Navigation::orderBy('order_priority', 'asc')->get();
        @endphp
        <ul class="sidenav__menu" role="menubar">
            <!-- Categories -->
            @foreach ($navs as $nav)
                @if ($nav->nav_type == 'normal')
                    <li>
                        <a href="{{ route('category', ['rubrik_name' => Str::slug($nav->navlinks[0]->rubrik->rubrik_name)]) }}"
                            class="sidenav__menu-url">{{ $nav->navlinks[0]->rubrik->rubrik_name }}</a>
                    </li>
                @else
                    @foreach ($nav->navlinks as $links)
                        <li>
                            <a href="{{ route('category', ['rubrik_name' => Str::slug($links->rubrik->rubrik_name)]) }}"
                                class="sidenav__menu-url">{{ $links->rubrik->rubrik_name }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach
            <li>
                <a href="{{ route('gallery') }}" class="sidenav__menu-url">Gallery</a>
            </li>
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
