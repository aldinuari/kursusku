
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KursusKu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eef0ff, #dfe4ff);
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(60, 65, 130, 0.12);
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand h1 {
            margin: 0 0 8px;
            color: #5556a8;
            font-size: 30px;
        }

        .brand p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 13px;
            border: 1px solid #d8d9e8;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #7778c9;
            box-shadow: 0 0 0 3px rgba(119, 120, 201, 0.12);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 75px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #6263ad;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
        }

        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin: 18px 0;
            font-size: 13px;
        }

        .remember-row label {
            display: flex;
            align-items: center;
            gap: 7px;
            margin: 0;
            font-weight: normal;
        }

        .remember-row a,
        .back-link {
            color: #6263ad;
            text-decoration: none;
        }

        .remember-row a:hover,
        .back-link:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 9px;
            background: #6566b5;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-button:hover {
            background: #51529c;
        }

        .error-message {
            margin-bottom: 18px;
            padding: 12px;
            border-radius: 8px;
            background: #fff0f0;
            color: #b42318;
            font-size: 13px;
        }

        .success-message {
            margin-bottom: 18px;
            padding: 12px;
            border-radius: 8px;
            background: #effaf2;
            color: #26743a;
            font-size: 13px;
        }

        .footer {
            margin-top: 22px;
            text-align: center;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="brand">
            <h1>KursusKu</h1>
            <p>Silakan masuk ke akun Anda</p>
        </div>

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        id="togglePassword"
                    >
                        Lihat
                    </button>
                </div>
            </div>

            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember" value="1">
                    Ingat saya
                </label>

                <a href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            </div>

            <button type="submit" class="login-button">
                Login
            </button>
        </form>

        <div class="footer">
            <a href="{{ url('/') }}" class="back-link">
                Kembali ke halaman utama
            </a>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const isHidden = password.type === 'password';

            password.type = isHidden ? 'text' : 'password';
            this.textContent = isHidden ? 'Sembunyikan' : 'Lihat';
        });
    </script>
</body>
</html>
