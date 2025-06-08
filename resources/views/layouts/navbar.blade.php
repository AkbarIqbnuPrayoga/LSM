<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center bg-light py-2">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center gap-4">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-envelope-fill text-danger fs-5"></i>
        <a href="mailto:PUSDIKLAT@admin.com" class="text-decoration-none fw-semibold" style="color: #d6336c;">
          PUSDIKLAT@admin.com
        </a>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-telephone-fill text-success fs-5"></i>
        <span class="fw-semibold" style="color: #2f9e44;">+62 888 8118 8118</span>
      </div>
    </div>

    <!-- social links tetap di sini -->
    <div class="social-links d-none d-md-flex align-items-center gap-3">
      <a href="#" class="twitter text-muted"><i class="bi bi-twitter fs-5"></i></a>
      <a href="#" class="facebook text-muted"><i class="bi bi-facebook fs-5"></i></a>
      <a href="#" class="instagram text-muted"><i class="bi bi-instagram fs-5"></i></a>
      <a href="#" class="linkedin text-muted"><i class="bi bi-linkedin fs-5"></i></a>
    </div>
  </div>
</section>


<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center shadow-sm">
  <div class="container d-flex align-items-center justify-content-between">

    <h1 class="logo d-flex align-items-center mb-0">
      <img src="{{ asset('images/logountar.png') }}" alt="Logo" style="height: 1.5em; margin-right: 0.3em; margin-bottom: 0.3em" />
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

    <nav id="navbar" class="navbar d-flex align-items-center">
      <ul class="list-unstyled d-flex mb-0 align-items-center gap-0">
        <li>
          <a class="nav-link scrollto d-flex align-items-center gap-1 {{ $activehome }}" href="{{ route('home') }}">
            <i class="bi bi-house-door-fill"></i> Home
          </a>
        </li>

        <li class="dropdown position-relative">
          <a href="#" class="d-flex align-items-center gap-1 {{ $activeprofile }}" data-bs-toggle="dropdown" aria-expanded="false" role="button">
            <i class="bi bi-info-circle-fill"></i> <span>About Us</span> <i class="bi bi-chevron-down"></i>
          </a>
          <ul class="dropdown-menu list-unstyled position-absolute mt-2">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('visimisi') }}">
                <i class="bi bi-bullseye"></i> Visi Misi
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('tujuan') }}">
                <i class="bi bi-flag-fill"></i> Tujuan
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('strukturorganisasi') }}">
                <i class="bi bi-diagram-3-fill"></i> Struktur Organisasi
              </a>
            </li>
          </ul>
        </li>

        <li>
          <a class="nav-link scrollto d-flex align-items-center gap-1" href="{{ route('pelatihan.saya') }}">
            <i class="bi bi-journal-code"></i> Pelatihan
          </a>
        </li>

        <li>
          <a class="nav-link scrollto d-flex align-items-center gap-1" href="{{ route('riwayat.index') }}">
            <i class="bi bi-clock-history"></i> Riwayat Pelatihan
          </a>
        </li>

        <li>
          <a class="nav-link scrollto d-flex align-items-center gap-1 {{ $activecontact }}" href="{{ route('contact') }}">
            <i class="bi bi-envelope-paper-fill"></i> Contact
          </a>
        </li>

        @guest
          <li>
            <a class="nav-link {{ $activelogin }}" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
        @else
          <li class="nav-item dropdown position-relative">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end list-unstyled position-absolute mt-2">
              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboardUser') }}">
                  <i class="bi bi-person-fill"></i> Profile
                </a>
              </li>
              @if(Auth::user()->hasRole('Admin'))
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('admin') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard Admin
                  </a>
                </li>
              @endif
              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </a>
              </li>
            </ul>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        @endguest
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header>

<!-- Tambahkan style khusus agar dropdown dan menu rapi, sesuai style file 1 -->
<style>
  #navbar ul li.dropdown > a {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.5rem 1rem;
    font-weight: 600;
    color: #0d6efd; /* Bootstrap primary blue */
    border-radius: 8px;
    transition: background-color 0.3s ease;
    cursor: pointer;
  }

  #navbar ul li.dropdown > a:hover,
  #navbar ul li.dropdown > a.active,
  #navbar ul li.dropdown > a:focus {
    background-color: #e7f1ff;
    color: #084298;
    text-decoration: none;
  }

  #navbar ul li.dropdown ul.dropdown-menu {
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    padding: 0.5rem 0;
    min-width: 220px;
  }

  #navbar ul li.dropdown ul.dropdown-menu li {
    margin: 0;
  }

  #navbar ul li.dropdown ul.dropdown-menu li a.dropdown-item {
    padding: 0.6rem 1.2rem;
    font-weight: 500;
    color: #212529;
    display: flex;
    align-items: center;
    gap: 0.6rem;
    border-left: 4px solid transparent;
    transition: background-color 0.3s ease, border-color 0.3s ease;
    text-decoration: none;
  }

  #navbar ul li.dropdown ul.dropdown-menu li a.dropdown-item:hover {
    background-color: #d1e7ff;
    border-left-color: #0d6efd;
    color: #0d6efd;
    text-decoration: none;
  }

  .navbar .dropdown-menu-end a.dropdown-item {
    padding: 0.6rem 1.2rem;
    font-weight: 600;
    color: #212529;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-radius: 6px;
    transition: background-color 0.3s ease;
    text-decoration: none;
  }

  .navbar .dropdown-menu-end a.dropdown-item:hover {
    background-color: #f0f4ff;
    color: #0d6efd;
    text-decoration: none;
  }
</style>

<!-- Pastikan Bootstrap JS sudah di-load di layout utama -->
