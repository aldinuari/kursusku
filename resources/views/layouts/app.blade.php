
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'KursusKu')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --kk-dark: #10152b;
            --kk-purple: #8065ff;
            --kk-blue: #4e9dff;
        }

        body {
            margin: 0;
            background: #f5f6fc;
            color: #10152b;
            font-family: Arial, sans-serif;
        }

        /* NAVBAR */
        .kk-navbar {
            background: var(--kk-dark);
            padding: 14px 0;
            box-shadow: 0 5px 20px rgba(16, 21, 43, .12);
        }

        .kk-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-size: 23px;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -.5px;
        }

        .kk-brand:hover {
            color: white;
        }

        .kk-brand-icon {
            display: flex;
            width: 39px;
            height: 39px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(135deg, #8065ff, #38bdf8);
            color: white;
        }

        .kk-brand span:last-child span {
            color: #9b8aff;
        }

        .kk-nav-link {
            padding: 10px 18px !important;
            border-radius: 30px;
            color: #d8dbee !important;
            font-weight: 600;
            transition: .2s;
        }

        .kk-nav-link:hover {
            background: rgba(255,255,255,.1);
            color: white !important;
        }

        .kk-nav-button {
            display: inline-block;
            padding: 11px 22px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(100deg, #8065ff, #4e9dff);
            color: white;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 5px 18px rgba(99,102,241,.25);
            transition: .25s;
        }

        .kk-nav-button:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(99,102,241,.35);
        }

        /* AREA KONTEN */
        .kk-main {
            min-height: 70vh;
        }

        @media (max-width: 991px) {
            .kk-nav-menu {
                padding-top: 15px;
            }

            .kk-nav-button {
                margin-top: 8px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark kk-navbar">
        <div class="container">

            <a class="kk-brand" href="{{ url('/') }}">
                <span class="kk-brand-icon">K</span>
                <span>Kursus<span>Ku</span></span>
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarKursusKu"
                    aria-controls="navbarKursusKu"
                    aria-expanded="false"
                    aria-label="Buka menu navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarKursusKu">
                <ul class="navbar-nav ms-auto align-items-lg-center kk-nav-menu">

                    <li class="nav-item">
                        <a class="nav-link kk-nav-link"
   href="{{ url('/') }}">
    Beranda
</a>
<a href="{{ route('courses.index') }}" class="nav-btn-kursus">
    📚 Daftar Kursus
</a>
              </li>
                    

                    <li class="nav-item">
                        <a class="kk-nav-button"
   href="{{ route('enrollments.create') }}">
    Daftar Sekarang →
</a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <main class="kk-main">
        <div class="container py-4">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">
                    {{ session('success') }}

                    <button type="button" class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Tutup"></button>
                </div>
            @endif

            @yield('content')

        </div>
    </main>

</body>
</html>
