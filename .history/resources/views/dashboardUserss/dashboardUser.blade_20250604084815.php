@extends('index')
@section('content')

    @php
      $nameroute = Route::currentRouteName();
      $activeprofile = '';
      $activesertifikasi = '';
      $activecontact = '';
      $activelogin = '';
      $activehome = '';
      if($nameroute == 'visimisi' || $nameroute == 'tujuan' || $nameroute == 'strukturorganisasi'){
        $activeprofile = 'active';
      } else if($nameroute == 'skemasertifikasi' || $nameroute == 'ujikompetensi' || $nameroute == 'sertifikat'){
        $activesertifikasi = 'active';
      } else if($nameroute == 'contact'){
        $activecontact = 'active';
      } else if($nameroute == 'login'){
        $activelogin = 'active';
      } else {
        $activehome = 'active';
      }
    @endphp

  <nav class="navbar">
  <ul>
    <li><a class="{{ $activehome }}" href="{{ route('home') }}">Home</a></li>
    <li class="dropdown"><a href="#" class="{{$activeprofile}}"><span>About Us</span> <i class="bi bi-chevron-down"></i></a>
      <ul>
        <li><a href="{{ route('visimisi') }}">Visi Misi</a></li>
        <li><a href="{{ route('tujuan') }}">Tujuan</a></li>
        <li><a href="{{ route('strukturorganisasi') }}">Struktur Organisasi</a></li>
      </ul>
    </li>
    <li><a href="#portfolio">Pelatihan</a></li>
    <li><a href="#contact" class="{{ $activecontact }}">Contact</a></li>

    <li style="margin-left: auto;">
      @guest
        <a class="{{ $activelogin }}" href="{{ route('login') }}">Login</a>
      @else
        <div class="dropdown">
          <a href="#" class="dropdown-toggle">{{ Auth::user()->name }}</a>
          <ul>
            <li><a href="{{ route('dashboardUser') }}">Profile</a></li>
            <li>
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </div>
      @endguest
    </li>
  </ul>
</nav>
  </div>
</header>

<div class="main-content">
  <div class="dashboard-box">
    <h1>Dashboard User</h1>

    <div class="info">
      <p><strong>Name:</strong> {{ $user->name }}</p>
      <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    @if (session('success'))
      <div class="success-message">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="error-message">
        <ul style="margin:0; padding-left:20px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('dashboardUser.update.password') }}">
      @csrf
      <label for="password">New Password:</label>
      <input type="password" name="password" id="password" required>

      <label for="password_confirmation">Password Confirmation:</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required>

      <button type="submit" class="btn-changePass">Change Password</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
    @csrf
       <button type="submit" class="btn-logout">Logout</button>
    </form>

    <form method="GET" action="{{ url('/') }}">
      <button type="submit" class="btn-back">Back</button>
    </form>
  </div>
</div>

<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="footer-contact">
        <h3>LSM<span>.</span></h3>
        <p>
          Jalan Letjen S. Parman No. 1<br>
          Tomang, Grogol Petamburan, Jakarta 11440<br>
          Indonesia <br><br>
          <strong>Phone:</strong> +62 888 8118 8118<br>
          <strong>Email:</strong> Admin@LSM.com<br>
        </p>
      </div>
      <div class="footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
        </ul>
      </div>
      <div class="footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
        </ul>
      </div>
      <div class="footer-links">
        <h4>Connect With Us</h4>
        <p>Gabung bersama kami untuk info lebih lanjut!</p>
        <div class="social-links">
          <a href="#"><i class="bx bxl-twitter"></i></a>
          <a href="#"><i class="bx bxl-facebook"></i></a>
          <a href="#"><i class="bx bxl-instagram"></i></a>
          <a href="#"><i class="bx bxl-skype"></i></a>
          <a href="#"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="left">&copy; Copyright <strong><span>LSM</span></strong>. All Rights Reserved</div>
    <div class="right">Designed by Julius</div>
  </div>
</footer>
</body>

@endsec