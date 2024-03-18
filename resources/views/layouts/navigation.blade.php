<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:; padding-bottom: 40px;">
    <!-- Brand Logo -->
    <div class="row">
        <img src="{{ Storage::url('public/avatars/' . Auth::user()->avatar) }}" alt="avatar"
            class="brand-image img-circle elevation-3 mx-auto" style="opacity: .8;">
    </div>
    <a href="{{ url('dashboard') }}" class="brand-link text-center">
        <span style="white-space:wrap;" class=" p-1 font-weight-light">{{ Auth::user()->display_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        {{-- <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="true">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(1) == 'editorial' ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Editorial
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('editorial.create') }}" class="nav-link">
                                <i class="far fa-file nav-icon"></i>
                                <p>Create Article</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('editorial.draft') }}" class="nav-link">
                                <i class="fa fa-copy nav-icon"></i>
                                <p>Draft</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('editorial.published') }}" class="nav-link">
                                <i class="fa fa-check-square nav-icon"></i>
                                <p>Published</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('editorial.scheduled') }}" class="nav-link">
                                <i class="fa fa-calendar nav-icon"></i>
                                <p>Scheduled</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('editorial.trash') }}" class="nav-link">
                                <i class="fa fa-trash nav-icon"></i>
                                <p>Trash</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item 
                {{ Request::segment(1) == 'wp-headline-management' ? 'menu-open' : '' }}
                {{ Request::segment(1) == 'rubrik-headline-management' ? 'menu-open' : '' }}
                {{ Request::segment(1) == 'topik-khusus' ? 'menu-open' : '' }}
                {{ Request::segment(1) == 'rubrik' ? 'menu-open' : '' }}
                {{ Request::segment(1) == 'editor-choice' ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-clipboard-list"></i>
                        <p>
                            Web Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('wp-headline-management', ['id' => 'wp']) }}" class="nav-link">
                                <i class="fas fa-bars nav-icon"></i>
                                <p>Headline WP</p>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::segment(1) == 'rubrik-headline-management' ? 'menu-open' : '' }}">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="fas fa-bars nav-icon"></i>
                                <p>Headline Rubrik</p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach (\App\Models\Rubrik::get() as $rubrik)
                                    <li class="nav-item">
                                        <a href="{{ route('rubrik-headline-management', ['id' => $rubrik->rubrik_id]) }}"
                                            class="nav-link">
                                            <i class="fas fa-bars nav-icon"></i>
                                            <p>{{ $rubrik->rubrik_name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('editor-choice') }}" class="nav-link">
                                <i class="fa fa-check-square nav-icon"></i>
                                <p>Pilihan Editor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('topik-khusus') }}" class="nav-link">
                                <i class="fa fa-calendar nav-icon"></i>
                                <p>Topik Khusus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rubrik.index') }}" class="nav-link">
                                <i class="fa fa-cogs nav-icon"></i>
                                <p>Rubrik Managament</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tags.index') }}" class="nav-link">
                                <i class="fa fa-hashtag nav-icon"></i>
                                <p>Tags Managament</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('galeri') }}" class="nav-link">
                        <i class="nav-icon fa fa-image"></i>
                        <p>
                            Galeri
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pushNotification.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Notification
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('breakingNews') }}" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Breaking News
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::segment(1) == 'report' ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-chart-bar"></i>
                        <p>
                            Report
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report.editor') }}" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Editor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.author') }}" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Penulis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report.articles') }}" class="nav-link">
                                <i class="far fa-file nav-icon"></i>
                                <p>Article</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('report.section') }}" class="nav-link">
                                <i class="far fa-file nav-icon"></i>
                                <p>Section</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('report.articles-user') }}" class="nav-link">
                                <i class="far fa-file nav-icon"></i>
                                <p>Article User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ Request::segment(1) == 'photo' ? 'menu-open' : '' }} {{ Request::segment(1) == 'videos' ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            Assets
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('assets.photo.index') }}" class="nav-link">
                                <i class="far fa-image nav-icon"></i>
                                <p>Photo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('assets.video.index') }}" class="nav-link">
                                <i class="fa fa-video nav-icon"></i>
                                <p>Video</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ads.index') }}" class="nav-link">
                        <i class="fa fa-tag nav-icon"></i>
                        <p>Ads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role != 'author')
                    <li class="nav-item">
                        <a href="{{ route('users') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Administartor
                            </p>
                        </a>
                    </li>


                    <li
                        class="nav-item  {{ in_array(Request::segment(1), ['generalSetting', 'setting', 'nav', 'footersetting']) ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Web Setting
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('setting.socials') }}" class="nav-link">
                                    <i class="fa fa-share-alt nav-icon"></i>
                                    <p>Auto Share</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('setting.general.index') }}" class="nav-link">
                                    <i class="fas fa-spell-check nav-icon"></i>
                                    <p>General</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('nav') }}" class="nav-link">
                                    <i class="fa fa-sitemap nav-icon"></i>
                                    <p>Menu / Navigation</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('setting.footer.index') }}" class="nav-link">
                                    <i class="fas fa-puzzle-piece nav-icon"></i>
                                    <p>Footer</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
