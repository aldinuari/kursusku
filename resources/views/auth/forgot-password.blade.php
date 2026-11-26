
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - KursusKu</title>
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
            background: #f0edff;
        }

        .container {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(80, 60, 140, 0.12);
        }

        h2 {
            color: #51418c;
            text-align: center;
            margin-top: 0;
        }

        p {
            color: #666;
            line-height: 1.6;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 13px;
            margin: 12px 0;
            border: 1px solid #d8d1f0;
            border-radius: 9px;
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 9px;
            background: #7661bd;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        a {
            display: block;
            margin-top: 18px;
            text-align: center;
            color: #6652a5;
            text-decoration: none;
        }

        .message {
            color: #287a45;
            margin-bottom: 12px;
        }

        .error {
            color: #c0392b;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lupa Password?</h2>

        <p>
            Masukkan email akun kamu untuk meminta
            tautan pengaturan ulang password.
        </p>

        @if (session('status'))
            <p class="message">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input
                type="email"
                name="email"
                placeholder="Masukkan email"
                value="{{ old('email') }}"
                required
            >

            <button type="submit">Kirim Link Reset Password</button>
        </form>

        <a href="{{ route('login') }}">Kembali ke halaman login</a>
    </div>
</body>
</html>
