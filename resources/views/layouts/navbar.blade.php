  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          @if(Auth::user()->level == 'Admin')
          Limit Posting Harian: {{Auth::user()->post_limit}} | Posting: {{Auth::user()->postsAuthor()->where('published_at', 'like', '%' . date('Y-m-d') . '%')->count()}}
          @endif
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->
