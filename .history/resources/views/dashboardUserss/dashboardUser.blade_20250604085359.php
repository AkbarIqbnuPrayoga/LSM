@extends('index')
@section('content')
<header id="header">
  <div class="container">
    <h1 class="logo"><a href="index.html">PUSDIKLAT</a></h1>

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
</body>

@endsection