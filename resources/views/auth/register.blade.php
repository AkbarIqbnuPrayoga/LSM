<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template_admin/assets/images/favicon.png') }}">
    <link href="{{ asset('template_admin/css/style.css') }}" rel="stylesheet">
    <style>
        .login-card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #fff;
        }

        .login-title {
            font-weight: bold;
            color: #0000ff;
            font-size: 24px;
        }

        .form-control {
            border-radius: 8px;
            padding-left: 16px;
            padding-right: 40px;
        }

        .login-form__btn {
            background-color: #0000ff;
            color: white;
            font-weight: bold;
            border-radius: 8px;
        }

        .signup-text {
            font-size: 14px;
        }
    </style>
</head>

<body class="h-100">
      <!-- Navbar -->
<nav style="background-color: #ffffff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 0.75rem 2rem; display: flex; align-items: center;">
    <img src="/images/logountar.png" alt="Logo" style="height: 40px; margin-right: 1rem;">
    <span style="font-weight: bold; font-size: 1.2rem; color: #000000;">PUSDIKLAT</span>
</nav>
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <!-- Gambar di kiri -->
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <img src="/images/login-page-img.png" alt="Register Illustration" class="img-fluid">
                </div>

                <!-- Form Register -->
                <div class="col-lg-4 col-md-8">
                    <div class="login-card">
                        <h3 class="text-center login-title mb-4">Register</h3>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="form-group mb-3">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Name">
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Email">
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="Password">
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-3">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirm Password">
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn login-form__btn w-100 mb-3">Sign Up</button>

                            <!-- Already have an account -->
                            <p class="text-center signup-text">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-primary">Sign In</a>
                            </p>
                        </form>
                    </div>
                </div> <!-- End Register Form -->
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('template_admin/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('template_admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('template_admin/js/settings.js') }}"></script>
    <script src="{{ asset('template_admin/js/gleek.js') }}"></script>
    <script src="{{ asset('template_admin/js/styleSwitcher.js') }}"></script>
</body>

</html>
