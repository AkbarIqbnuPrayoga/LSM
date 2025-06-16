<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
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
                <!-- Form Forgot Password -->
                <div class="col-lg-4 col-md-8">
                    <div class="login-card">
                        <h3 class="text-center login-title mb-4">Forgot Password</h3>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group position-relative mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn login-form__btn w-100 mb-3">
                                Send Password Reset Link
                            </button>

                            <div class="text-center">
                                <a href="{{ route('login') }}" class="text-primary">Back to Login</a>
                            </div>

                        </form>
                    </div>
                </div> <!-- End Forgot Password Form -->
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
