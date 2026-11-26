
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KursusKu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f2ff;
            color: #34345b;
        }

        .navbar {
            background: #6566b5;
            color: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 18px;
        }

        .container {
            max-width: 1050px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(60, 65, 130, 0.08);
        }

        .welcome h1 {
            color: #5556a8;
            margin-top: 0;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 18px;
            margin-top: 25px;
        }

        .menu a {
            background: white;
            padding: 24px;
            border-radius: 13px;
            text-decoration: none;
            color: #5556a8;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(60, 65, 130, 0.07);
        }

        .menu a:hover {
            background: #e8e9ff;
        }

        .logout-button {
            background: #fff;
            color: #5556a8;
            border: none;
            padding: 9px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .success {
            padding: 12px;
            background: #e8f8ec;
            color: #26743a;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 15px 20px;
                flex-wrap: wrap;
                gap: 12px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <h2>KursusKu</h2>

        <div>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('courses.index') }}">Kursus</a>

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </nav>

    <main class="container">

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <section class="welcome">
            <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>

            <p>Anda berhasil masuk ke sistem KursusKu.</p>

            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

            <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
        </section>

        <section class="menu">
            <a href="{{ route('courses.index') }}">Kelola Kursus</a>
            <a href="{{ route('enrollments.index') }}">Data Enrollment</a>
            <a href="{{ route('participants.create') }}">Pendaftaran Peserta</a>
            <a href="{{ route('home') }}">Halaman Beranda</a>
        </section>

    </main>

</body>
</html>
