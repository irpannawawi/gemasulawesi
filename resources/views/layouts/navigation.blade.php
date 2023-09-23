<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
        <img src="{{ url('assets/AdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Gemasulawesi</span>
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
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                              Editorial
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{route('editorial.create')}}" class="nav-link">
                                  <i class="far fa-file nav-icon"></i>
                                  <p>Create Article</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{route('editorial.draft')}}" class="nav-link">
                                  <i class="fa fa-copy nav-icon"></i>
                                  <p>Draft</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{route('editorial.published')}}" class="nav-link">
                                  <i class="fa fa-check-square nav-icon"></i>
                                  <p>Published</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{route('editorial.scheduled')}}" class="nav-link">
                                  <i class="fa fa-calendar nav-icon"></i>
                                  <p>Scheduled</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{route('editorial.trash')}}" class="nav-link">
                                  <i class="fa fa-trash nav-icon"></i>
                                  <p>Trash</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-clipboard-list"></i>
                          <p>
                              Web Management
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{route('wp-headline-management', ['id'=>'wp'])}}" class="nav-link">
                                  <i class="fas fa-bars nav-icon"></i>
                                  <p>Headline WP</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="fas fa-bars nav-icon"></i>
                                  <p>Headline Rubrik</p>
                              <i class="fas fa-angle-left right"></i>
                              </a>
                              <ul class="nav nav-treeview">
                                @foreach (\App\Models\Rubrik::get() as $rubrik )
                                    
                                <li class="nav-item">
                                    <a href="{{route('rubrik-headline-management', ['id'=>$rubrik->rubrik_id])}}" class="nav-link">
                                        <i class="fas fa-bars nav-icon"></i>
                                        <p>{{$rubrik->rubrik_name}}</p>
                                    </a>
                                </li>
                                @endforeach
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="{{route('editor-choice')}}" class="nav-link">
                                  <i class="fa fa-check-square nav-icon"></i>
                                  <p>Pilihan Editor</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="fa fa-calendar nav-icon"></i>
                                  <p>Topik Khusus</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{route('rubrik.index')}}" class="nav-link">
                                  <i class="fa fa-cogs nav-icon"></i>
                                  <p>Rubrik Managament</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-image"></i>
                          <p>
                              Galeri
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                  </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>
                            Notification
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>
                            Breaking News
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-chart-bar"></i>
                        <p>
                            Report
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
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
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Administartor
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
