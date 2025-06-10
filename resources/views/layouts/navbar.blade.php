<!-- Tambahkan ini di bagian <head> -->
<style>
  .navbar .nav-link {
    color: black;
  }

  .navbar .nav-link:hover {
    color: #0d6efd !important;
  }
</style>

<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center bg-light py-2">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center gap-4">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-envelope-fill text-danger fs-5"></i>
        <a href="mailto:PUSDIKLAT@admin.com" class="text-decoration-none fw-semibold text-danger">
          PUSDIKLAT@admin.com
        </a>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-telephone-fill text-success fs-5"></i>
        <span class="fw-semibold text-success">+62 888 8118 8118</span>
      </div>
    </div>

    <div class="social-links d-none d-md-flex align-items-center gap-3">
      <a href="#" class="text-muted"><i class="bi bi-twitter fs-5"></i></a>
      <a href="#" class="text-muted"><i class="bi bi-facebook fs-5"></i></a>
      <a href="#" class="text-muted"><i class="bi bi-instagram fs-5"></i></a>
      <a href="#" class="text-muted"><i class="bi bi-linkedin fs-5"></i></a>
    </div>
  </div>
</section>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center shadow-sm">
  <div class="container d-flex align-items-center justify-content-between">
    <h1 class="logo d-flex align-items-center mb-0">
      <img src="{{ asset('images/logountar.png') }}" alt="Logo" class="me-2" style="height: 1.5em;" />
      <a href="{{ route('home') }}" class="text-decoration-none fs-4 fw-bold">PUSDIKLAT</a>
    </h1>

    @php
      $nameroute = Route::currentRouteName();
      $activeprofile = '';
      $activesertifikasi = '';
      $activecontact = '';
      $activelogin = '';
      $activehome = '';
      if ($nameroute == 'visimisi' || $nameroute == 'tujuan' || $nameroute == 'strukturorganisasi') {
        $activeprofile = 'active';
      } elseif ($nameroute == 'skemasertifikasi' || $nameroute == 'ujikompetensi' || $nameroute == 'sertifikat') {
        $activesertifikasi = 'active';
      } elseif ($nameroute == 'contact') {
        $activecontact = 'active';
      } elseif ($nameroute == 'login') {
        $activelogin = 'active';
      } else {
        $activehome = 'active';
      }
    @endphp

    <nav id="navbar" class="navbar">
      <ul class="navbar-nav flex-row gap-2 align-items-center mb-0 list-unstyled">

        <li>
          <a class="nav-link gap-1" href="{{ route('home') }}">
            <i class="bi bi-house-door-fill"></i> Home
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle gap-1 {{ $activeprofile }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-info-circle-fill"></i> About Us
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('visimisi') }}"><i class="bi bi-bullseye"></i> Visi Misi</a></li>
            <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('tujuan') }}"><i class="bi bi-flag-fill"></i> Tujuan</a></li>
            <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('strukturorganisasi') }}"><i class="bi bi-diagram-3-fill"></i> Struktur Organisasi</a></li>
          </ul>
        </li>

        <li>
          <a class="nav-link gap-1" href="{{ route('pelatihan.saya') }}">
            <i class="bi bi-journal-code"></i> Pelatihan
          </a>
        </li>

        <li>
          <a class="nav-link gap-1" href="{{ route('riwayat.index') }}">
            <i class="bi bi-clock-history"></i> Riwayat Pelatihan
          </a>
        </li>

        <li>
          <a class="nav-link gap-1 {{ $activecontact }}" href="{{ route('contact') }}">
            <i class="bi bi-envelope-paper-fill"></i> Contact
          </a>
        </li>

        @guest
        @guest
          <li>
            <a class="nav-link gap-1 {{ $activelogin }}" href="{{ route('login') }}">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
          </li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" style="max-width: 200px;">
              @if(Auth::user()->hasRole('Admin'))
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard Admin
                  </a>
                </li>
              @endif
              <li>
                <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('dashboardUser') }}">
                  <i class="bi bi-person-fill"></i> Profile
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </a>
              </li>
            </ul>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        @endguest

      </ul>
      <i class="bi bi-list mobile-nav-toggle d-block d-lg-none"></i>
    </nav>
  </div>
</header>