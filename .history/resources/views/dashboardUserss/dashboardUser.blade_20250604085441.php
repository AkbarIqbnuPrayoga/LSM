@extends('index')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard User</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
    <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f7f9fc;
    }

    header {
      background-color: white;
      padding: 15px 30px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }



    .main-content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 20px;
    }

    .dashboard-box {
      background: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      max-width: 450px;
      width: 100%;
    }

    h1 {
      text-align: center;
      margin-bottom: 25px;
    }

    .info p {
      margin: 10px 0;
      font-size: 16px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input[type="password"] {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      width: 100%;
      padding: 10px;
      margin-top: 15px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      color: white;
      cursor: pointer;
    }

    .btn-changePass { background-color: #007bff; }
    .btn-logout { background-color: #dc3545; }
    .btn-back { background-color: #007bff; }

    .success-message, .error-message {
      padding: 10px;
      margin-top: 10px;
      border-radius: 5px;
    }

    .success-message {
      background-color: #d4edda;
      color: #155724;
    }

    .error-message {
      background-color: #f8d7da;
      color: #721c24;
    }

    footer {
      background: #ffffff;
      color: rgb(27, 23, 23);
      width: 100%;
      font-size: 14px;
    }

    footer .footer-top {
      padding: 40px 20px;
    }

    footer h3, footer h4 {
      color: #000;
      font-weight: bold;
    }

    .footer-top ul, .footer-contact p, .footer-top ul li a {
      color: #6c757d;
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-top .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 20px;
    }

    .footer-contact, .footer-links {
      flex: 1 1 200px;
    }

    .footer-top ul li {
      margin-bottom: 10px;
    }

    .footer-top ul li i {
      margin-right: 10px;
    }

    .social-links a {
      display: inline-block;
      margin-right: 10px;
      font-size: 18px;
      color:rgb(255, 255, 255);
      padding: 6px;              
      background-color: #007bff; 
      border-radius: 10%;      
      box-shadow: 0 0 5px rgba(0,0,0,0.1); 
      transition: background-color 0.3s, color 0.3s;
     }

    .footer-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 40px 50px;
      background: #f1f6fd;
      flex-wrap: wrap;
    }

    .footer-bottom .left, .footer-bottom .right {
      font-size: 14px;
      color: #6c757d;
    }

    .footer-bottom .left strong {
      color: #000;
    }

    .footer-bottom .right a {
      color: #6c757d;
      text-decoration: none;
    }

    .footer-bottom .right a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      header .container {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar {
        width: 100%;
      }

      .navbar ul {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .main-content {
        padding: 10px;
      }

      .footer-top .container,
      .footer-bottom {
        flex-direction: column;
        text-align: center;
        gap: 10px;
      }
    }
  </style>
</head>

</html>
<body>
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