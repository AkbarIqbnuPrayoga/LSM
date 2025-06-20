@extends('index')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f7;
            color: #333;
            scroll-behavior: smooth;
        }

        .main-content {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            background: linear-gradient(145deg, #f2f6fc, #dce3f0);
        }

        .container-cards {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .dashboard-box {
            background: #ffffff;
            padding: 40px 35px;
            border-radius: 18px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            max-width: 440px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #dfe6f1;
        }

        .dashboard-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 50px rgba(0, 0, 0, 0.08);
        }

        h1 {
            text-align: center;
            margin-bottom: 32px;
            font-size: 28px;
            color: #1a1aff;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .info p {
            margin: 10px 0;
            font-size: 15px;
            color: #444;
            line-height: 1.6;
        }
        .input-update-name {
            width: 100%;
            padding: 14px 16px;
            margin-top: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 15px;
            box-sizing: border-box;
            background-color: #fefefe;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-update-name:focus {
            border-color: #1a1aff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(26, 26, 255, 0.1);
        }

        form {
            margin-top: 20px;
        }

        input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            margin-top: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 15px;
            box-sizing: border-box;
            background-color: #fefefe;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="password"]:focus {
            border-color: #1a1aff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(26, 26, 255, 0.1);
        }

        .btn-changePass {
            background-color: #1a1aff;
            color: white;
            width: 100%;
            padding: 13px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 22px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-changePass:hover {
            background-color: #0000cc;
            transform: translateY(-2px);
        }

        .btn-logout,
        .btn-back {
            background-color: #f4f5f7;
            color: #444;
            border: 1px solid #ccc;
            width: 100%;
            padding: 11px;
            margin-top: 12px;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .btn-logout:hover,
        .btn-back:hover {
            background-color: #e2e6ea;
            border-color: #bbb;
            transform: scale(1.01);
        }

        .success-message,
        .error-message {
            padding: 12px 16px;
            margin-top: 18px;
            border-radius: 8px;
            font-size: 14px;
            line-height: 1.5;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        ul {
            padding-left: 18px;
            margin: 0;
        }

        @media screen and (max-width: 480px) {
            .dashboard-box {
                padding: 30px 20px;
            }

            h1 {
                font-size: 24px;
            }

            input[type="password"],
            .btn-changePass,
            .btn-logout,
            .btn-back {
                font-size: 14px;
                padding: 12px;
            }
        }

        .user-card {
            background-color: #f9fbfd;
            border: 1px solid #e1e7ef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
            transition: box-shadow 0.3s ease;
        }

        .user-card:hover {
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.06);
        }

        .user-info {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #d0d7e2;
        }

        .user-info:last-child {
            border-bottom: none;
        }

        .user-info .label {
            font-weight: 600;
            color: #666;
        }

        .user-info .value {
            color: #111;
            font-weight: 500;
        }
    </style>
@endpush




@section('content')
    <div class="main-content">
        <div class="container-cards">
            <div class="dashboard-box">
                <h1>Dashboard User</h1>

                <div class="user-card">
                    <div class="user-info">
                        <div class="label">Name</div>
                        <div class="value">{{ $user->name }}</div>
                    </div>
                    <div class="user-info">
                        <div class="label">Email</div>
                        <div class="value">{{ $user->email }}</div>
                    </div>
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

                {{-- ✅ Form Ganti Nama --}}
                <form method="POST" action="{{ route('dashboardUser.update.name') }}">
                    @csrf
                    <label for="new_name">Change Name:</label>
                    <input type="text" name="new_name" id="new_name" class="input-update-name" value="{{ $user->name }}" required>
                    <button type="submit" class="btn-changePass" style="margin-top: 16px;">Update Name</button>
                </form>

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
    </div>
@endsection
