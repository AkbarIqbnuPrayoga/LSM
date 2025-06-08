<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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

        .input-group-text {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
        }

        .login-form__btn {
            background-color: #0000ff;
            color: white;
            font-weight: bold;
            border-radius: 8px;
        }

        .forgot-password,
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
                    <img src="/images/login-page-img.png" alt="Login Illustration" class="img-fluid">
                </div>

                <!-- Form Login -->
                <div class="col-lg-4 col-md-8">
                    <div class="login-card">
                        
                        <h3 class="text-center login-title mb-4">Login</h3>


                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="form-group position-relative mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ old('email') }}">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group position-relative mb-3">
                                <input type="password" name="password" class="form-control" placeholder="**********">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Remember & Forgot -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Remember</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-primary forgot-password">Forgot
                                    Password</a>
                            </div>

                            <button type="submit" class="btn login-form__btn w-100 mb-3">Sign In</button>

                            <!-- Sign Up -->
                            <p class="text-center signup-text">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="text-primary">Sign Up</a>
                            </p>

                        </form>

                    </div>
                </div> <!-- End Login Form -->
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
