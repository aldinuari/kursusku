
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - KursusKu</title>

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
        }

        input {
            width: 100%;
            padding: 13px;
            margin: 10px 0;
            border: 1px solid #d8d1f0;
            border-radius: 9px;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 10px;
            border: none;
            border-radius: 9px;
            background: #7661bd;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .error {
            color: #c0392b;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Buat Password Baru</h2>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input
                type="hidden"
                name="token"
                value="{{ $token }}"
            >

            <input
                type="email"
                name="email"
                placeholder="Email akun"
                value="{{ old('email', $email) }}"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password baru (minimal 8 karakter)"
                required
                minlength="8"
                autocomplete="new-password"
            >

            <input
                type="password"
                name="password_confirmation"
                placeholder="Konfirmasi password baru"
                required
                minlength="8"
                autocomplete="new-password"
            >

            <button type="submit">Simpan Password Baru</button>
        </form>
    </div>
</body>
</html>
