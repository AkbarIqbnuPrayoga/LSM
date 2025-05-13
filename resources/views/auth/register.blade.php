<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template_admin/assets/images/favicon.png') }}">
    <link href="{{ asset('template_admin/css/style.css') }}" rel="stylesheet">
</head>

<body class="h-100">

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="{{ url('/') }}">
                                    <h4>Login</h4>
                                </a>

                                <form class="mt-5 mb-5 login-input" method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus
                                            placeholder="Name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="Email address">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="Confirm Password">
                                    </div>

                                    <button type="submit" class="btn login-form__btn submit w-100">Sign Up</button>
                                </form>

                                <p class="mt-5 login-form__footer">Already have an account?
                                    <a href="{{ route('login') }}" class="text-primary">Sign In</a> now
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template_admin/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('template_admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('template_admin/js/settings.js') }}"></script>
    <script src="{{ asset('template_admin/js/gleek.js') }}"></script>
    <script src="{{ asset('template_admin/js/styleSwitcher.js') }}"></script>
</body>

</html>
