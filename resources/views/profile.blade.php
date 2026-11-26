
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - KursusKu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #f1f2ff;
            color: #34345b;
        }

        .profile-card {
            max-width: 550px;
            margin: 30px auto;
            padding: 32px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(60, 65, 130, 0.08);
        }

        h1 {
            margin-top: 0;
            color: #5556a8;
        }

        .profile-item {
            padding: 15px 0;
            border-bottom: 1px solid #eeeeF5;
        }

        .profile-item strong {
            display: block;
            margin-bottom: 7px;
            color: #777;
            font-size: 13px;
        }

        .profile-item span {
            font-size: 16px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 25px;
        }

        .actions a {
            padding: 11px 16px;
            border-radius: 8px;
            background: #6566b5;
            color: white;
            text-decoration: none;
        }

        .actions a:hover {
            background: #51529c;
        }
    </style>
</head>

<body>

    <main class="profile-card">
        <h1>Profil Saya</h1>
        <p>Informasi akun KursusKu Anda.</p>

        <div class="profile-item">
            <strong>Nama Lengkap</strong>
            <span>{{ auth()->user()->name }}</span>
        </div>

        <div class="profile-item">
            <strong>Email</strong>
            <span>{{ auth()->user()->email }}</span>
        </div>

        <div class="profile-item">
            <strong>Role Akun</strong>
            <span>{{ auth()->user()->role }}</span>
        </div>

        <div class="actions">
            <a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>
            <a href="{{ route('home') }}">Beranda</a>
        </div>
    </main>

</body>
</html>
