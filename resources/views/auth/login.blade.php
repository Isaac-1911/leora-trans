<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Leora Trans</title>

    @vite([
        'resources/css/app.css'
    ])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0a0a;
            color: #e8e8e8;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 380px;
            padding: 28px 30px 32px;
            background: #141414;
            border: 1px solid #2a2a2a;
            border-radius: 6px;
            position: relative;
        }

        /* BMW-inspired accent line */
        .login-container::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 30px;
            right: 30px;
            height: 2px;
            background: linear-gradient(90deg, #00a6ff 0%, #0066b1 50%, #e22718 100%);
            border-radius: 0 0 2px 2px;
        }

        .logo {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 2.5px;
            margin-bottom: 4px;
            color: #f0f0f0;
        }

        .logo-sub {
            font-size: 9px;
            letter-spacing: 3px;
            color: #666;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .m-stripe {
            display: flex;
            width: 48px;
            height: 2.5px;
            margin-bottom: 18px;
        }

        .m-stripe span {
            flex: 1;
        }

        .blue-light {
            background: #00a6ff;
        }
        .blue-dark {
            background: #0066b1;
        }
        .red {
            background: #e22718;
        }

        .subtitle {
            color: #888;
            font-size: 11px;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 9px;
            letter-spacing: 1.2px;
            color: #777;
            text-transform: uppercase;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            height: 36px;
            background: #1a1a1a;
            border: 1px solid #2e2e2e;
            border-radius: 3px;
            color: #e8e8e8;
            padding: 0 12px;
            outline: none;
            font-size: 12px;
            transition: border-color 0.2s ease;
        }

        .form-group input::placeholder {
            color: #4a4a4a;
            font-size: 11px;
        }

        .form-group input:focus {
            border-color: #007aff;
            background: #1d1d1d;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 18px;
            font-size: 11px;
            color: #888;
        }

        .remember input[type="checkbox"] {
            width: 14px;
            height: 14px;
            accent-color: #007aff;
            cursor: pointer;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 2px;
        }

        .login-btn {
            width: 100%;
            height: 38px;
            background: #f0f0f0;
            color: #0a0a0a;
            border: none;
            border-radius: 3px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.5px;
            cursor: pointer;
            transition: all 0.25s ease;
            text-transform: uppercase;
        }

        .login-btn:hover {
            background: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(255, 255, 255, 0.06);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .forgot {
            display: block;
            text-align: right;
            margin-top: 10px;
            font-size: 10px;
            color: #4a7aff;
            text-decoration: none;
            letter-spacing: 0.3px;
            transition: color 0.2s ease;
        }

        .forgot:hover {
            color: #6b96ff;
            text-decoration: underline;
        }

        .error {
            color: #ff5555;
            font-size: 10px;
            margin-top: 4px;
        }

        .status {
            background: #0d1a2b;
            border-left: 2px solid #1e40af;
            padding: 8px 12px;
            margin-bottom: 18px;
            font-size: 11px;
            color: #8ab4ff;
            border-radius: 2px;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .login-container {
                padding: 24px 20px 28px;
                max-width: 100%;
            }
            .logo {
                font-size: 18px;
            }
            .login-container::before {
                left: 20px;
                right: 20px;
            }
        }
    </style>

</head>

<body>
    <div class="login-container">
        <div class="logo">
            LEORA TRANS
        </div>
        <div class="logo-sub">
            ADMINISTRATOR
        </div>

        <div class="m-stripe">
            <span class="blue-light"></span>
            <span class="blue-dark"></span>
            <span class="red"></span>
        </div>

        <p class="subtitle">
            Enter your credentials
        </p>

        @if(session('status'))
            <div class="status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="your@email.com"
                       required
                       autofocus>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password"
                       name="password"
                       placeholder="••••••••"
                       required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" style="cursor:pointer;">Remember Me</label>
            </div>

            <button type="submit" class="login-btn">
                Sign In
            </button>

            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot">
                    Forgot Password?
                </a>
            @endif
        </form>
    </div>
</body>

</html>
