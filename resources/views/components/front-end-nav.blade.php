@php
    use App\Models\Navigation;
    use Illuminate\Support\Carbon;

@endphp

<!-- Header -->
<header class="header d-lg-block d-none">
    <div class="container">
        <div class="flex-parent align-items-center">

            <!-- Date -->
            <nav class="flex-child header__menu d-none d-lg-block">
                <ul class="header__menu-list">
                    <li><a>{{ Carbon::now()->locale('id_ID')->isoFormat('dddd, DD MMMM YYYY') }}</a></li>
                </ul>
            </nav>

            <!-- end date -->

            <div class="flex-child text-center mt-3 mb-3 d-flex align-items-center">
                <!-- Logo -->
                <a href="{{ url('') }}" class="logo ">
                    <img class="logo__img" src="{{ Storage::url('public/logo/') . get_setting('logo_web') }}"
                        srcset="{{ Storage::url('public/logo/') . get_setting('logo_web') }}" alt="logo"
                        width="280" height="280">
                </a>
            </div>

            <!-- Socials -->
            <div class="flex-child">
                <div class="d-flex align-items-center" style="gap: 20px;position: relative;">
                    <div class="nav__right-item nav__search">
                        <a href="javascript:;" class="nav__search-trigger nav__search-trigger-lg">
                            <i class="ui-search nav__search-trigger-icon"></i>
                        </a>
                        <div class="nav__search-box" style="right: 0%;z-index: 121;">
                            <form class="nav__search-form" action="{{ route('search') }}">
                                <input type="text" name="q" placeholder="Search..." class="nav__search-input"
                                    value="{{ request('q') }}">
                                <button type="submit" class="search-button btn btn-lg btn-color btn-button">
                                    <i class="ui-search "></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="socials socials--nobase socials--nav socials--dark justify-content-end">
                        <a class="social social-facebook" href="https://{{ get_setting('facebook') }}" target="_blank"
                            aria-label="facebook">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a class="social social-twitter" href="https://{{ get_setting('x') }}" target="_blank"
                            aria-label="twitter">
                            <i class="fa-brands fa-square-x-twitter"></i>
                        </a>
                        <a class="social social-youtube" href="https://{{ get_setting('youtube') }}" target="_blank"
                            aria-label="youtube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a class="social social-instagram" href="https://{{ get_setting('instagram') }}" target="_blank"
                            aria-label="instagram">
                            <i class="fa-brands fa-square-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- end container -->
</header> <!-- end header -->

<!-- Navigation -->
<header class="nav nav--colored mb-3" id="scroll">
    <div class="nav__holder nav--sticky">
        <div class="container relative">
            <div class="flex-parent">
                <div class="flex-parent">
                    <div class="nav__home">
                        <a href="{{ url('/') }}" title="Home">
                            <i class="icon fa fa-home"></i>
                        </a>
                    </div>
                    <!-- Side Menu Button -->
                    <button class="nav-icon-toggle" id="nav-icon-toggle" aria-label="Open side menu">
                        <span class="nav-icon-toggle__box">
                            <span class="nav-icon-toggle__inner"></span>
                        </span>
                    </button>
                </div>
                <!-- Nav-wrap -->
                <nav class="flex-child d-none d-lg-block">
                    <ul class="nav__menu">
                        <li>
                            <a href="{{ url('/') }}" class="link-nav__menu" style="white-space: nowrap;">Home</a>
                        </li>
                        @php
                            $navs = Navigation::orderBy('order_priority', 'asc')->get();
                        @endphp
                        @foreach ($navs as $nav)
                            @if ($nav->nav_type == 'normal')
                                <li>
                                    <a href="{{ route('category', ['rubrik_name' => Str::slug($nav->navlinks[0]->rubrik->rubrik_name)]) }}"
                                        class="link-nav__menu"
                                        style="white-space: nowrap;">{{ $nav->navlinks[0]->rubrik->rubrik_name }}</a>
                                </li>
                            @else
                                <li style="margin-left: 9px; margin-right:9px;">
                                    <div class="nav__right-item nav__lainnya d-none d-lg-block">
                                        <ul class="nav__menu menu__lainnya">
                                            <li class="dropdown__rubrik">
                                                <a href="javascript:;">
                                                    {{ $nav->nav_name }}
                                                </a>
                                                <ul class="submenu">
                                                    @foreach ($nav->navlinks as $links)
                                                        <li>
                                                            <a href="{{ route('category', ['rubrik_name' => Str::slug($links->rubrik->rubrik_name)]) }}"
                                                                class="link-submenu"
                                                                style="white-space: nowrap;">{{ $links->rubrik->rubrik_name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                        <li class="text-white" style="margin-left: 9px; margin-right:9px;">|</li>
                        <li>
                            <a href="{{ route('gallery') }}" style="white-space: nowrap;">Gallery</a>
                        </li>
                    </ul>
                    <!-- end menu -->
                </nav>

                <!-- Logo Mobile -->
                <a href="{{ url('') }}" class="logo mt-1 logo-mobile d-lg-none" style="">
                    <img class="logo__img img img-responsive" style="max-height: 55px;"
                        src="{{ Storage::url('public/logo/') . get_setting('logo_web') }}"
                        srcset="{{ Storage::url('public/logo/') . get_setting('logo_web') }} 1x, {{ Storage::url('public/logo/') . get_setting('logo_web') }} 2x"
                        alt="logo">
                </a>
                <!-- Nav Right -->
                <div class="flex-child">
                    <div class="nav__right">
                        <!-- Search -->
                        <div class="nav__right-item nav__search d-block d-lg-none">
                            <a href="javascript:;" class="nav__search-trigger nav__search-trigger-lg">
                                <i class="ui-search" style="color: #2cc38b;"></i>
                            </a>
                            <div class="nav__search-box">
                                <form class="nav__search-form" action="{{ route('search') }}">
                                    <input type="text" name="q" placeholder="Search..."
                                        class="nav__search-input" value="{{ request('q') }}">
                                    <button type="submit" class="search-button btn btn-lg btn-color btn-button">
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

    @php
        $navs = Navigation::orderBy('order_priority', 'asc')->get();
    @endphp
    {{-- Baruuu --}}
    <div class="overflow-auto py-2 nav-mobile-container d-block w-100 d-lg-none">
        <ul class="d-flex">
            @foreach ($navs as $nav)
                @if ($nav->nav_type == 'normal')
                    <li class="nav-item">
                        <a href="{{ route('category', ['rubrik_name' => Str::slug($nav->navlinks[0]->rubrik->rubrik_name)]) }}"
                            class="nav-link text-nowrap nav-link-mobile"
                            style="padding: 8px;">{{ $nav->nav_name }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="javascript:;" 
                            class="nav-link nav-link-mobile toggle-mobile-dropdown text-nowrap">
                            {{ $nav->nav_name }}
                            <i class="subicon fa-solid fa-caret-down"></i>
                        </a>

                        <ul class="nav-mobile-dropdown" style="z-index: 100;">
                            @foreach ($nav->navlinks as $nv)
                                <li class="nav-item">
                                    <a href="{{ route('category', ['rubrik_name' => Str::slug($nv->rubrik->rubrik_name)]) }}"
                                        class="nav-link nav-link-dropdown">{{ $nv->rubrik->rubrik_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
            <li class="nav-item">
                <a class="nav-link nav-link-mobile" href="{{ route('gallery') }}" style="white-space: nowrap;">Gallery</a>
            </li>
        </ul>
    </div>
    {{-- end Baruu --}}
</header> <!-- end navigation -->

<script>
    document.addEventListener('DOMContentLoaded', function() {

        
    });
</script>
