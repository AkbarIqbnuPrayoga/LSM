<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:PUSDIKLAT@admin.com">PUSDIKLAT@admin.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+62 888 8118 8118</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo d-flex align-items-center">
        <img src="{{ asset('images/logountar.png') }}" alt="Logo" style="height: 1.5em; margin-right: 0.3em; margin-bottom: 0.3em">
        <a href="{{ route('home') }}" class="text-decoration-none">PUSDIKLAT</a>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="{{ asset('biz') }}/assets/img/logo.png" alt=""></a>-->
       @php
            $nameroute = Route::currentRouteName();
            $activeprofile = '';
            $activesertifikasi = '';
            $activecontact = '';
            $activelogin = '';
            $activehome = '';
            if($nameroute == 'visimisi' || $nameroute == 'tujuan' || $nameroute == 'strukturorganisasi'){
              $activeprofile = 'active';
            }else if($nameroute == 'skemasertifikasi' || $nameroute == 'ujikompetensi' || $nameroute == 'sertifikat'){
              $activesertifikasi = 'active';
            }else if($nameroute == 'contact'){
              $activecontact = 'active';
            }else if($nameroute == 'login'){
              $activelogin = 'active';
            }else{
              $activehome = 'active';
            }
          @endphp

      <nav id="navbar" class="navbar d-flex align-items-center">
        <!-- Form pencarian di sebelah kiri menu -->
        <form method="GET" action="{{ route('pelatihan.cari') }}" class="d-flex me-3">
            <input type="text" name="search" class="form-control rounded-pill me-2" placeholder="Cari pelatihan...">
            <button type="submit" class="btn btn-primary rounded-pill">Cari</button>
        </form>
        <ul>
          <!-- <li><a class="nav-link scrollto {{$activehome}}" href="{{route('admin')}}">Dashboard Admin</a></li> -->
          <li><a class="nav-link scrollto {{$activehome}}" href="{{route('home')}}">Home</a></li>
          <li class="dropdown"><a href="#" class="{{$activeprofile}}"><span>About Us</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route('visimisi')}}">Visi Misi</a></li>
              <li><a href="{{route('tujuan')}}">Tujuan</a></li>
              <li><a href="{{route('strukturorganisasi')}}">Struktur Organisasi</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="{{ route('pelatihan.saya') }}"><span>Pelatihan</span></a>
          </li>
          <li><a class="nav-link scrollto {{ $activeriwayat ?? '' }}" href="{{ route('riwayat.index') }}">Riwayat Pelatihan</a></li>

          <li><a href="{{ route('contact') }}">Contact</a></li>
          @guest
          <li>
            <a class="nav-link {{$activelogin}}" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @else
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('dashboardUser') }}">
            {{ __('Profile') }}
        </a>

       @if(Auth::user()->hasRole('Admin'))

        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
            {{ __('Dashboard Admin') }}
        </a>
        @endif

        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
@endguest

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


