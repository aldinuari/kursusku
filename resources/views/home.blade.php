
@extends('layouts.app')

@section('title', 'KursusKu - Belajar Skill Digital')

@section('content')
<style>
    :root {
        --kk-dark: #10152b;
        --kk-purple: #7357f6;
        --kk-blue: #38bdf8;
        --kk-light: #f5f6fc;
    }

    .kk-home {
        background: var(--kk-light);
        color: var(--kk-dark);
        overflow: hidden;
    }

    .kk-hero {
        position: relative;
        padding: 90px 0 100px;
        color: white;
        background:
            radial-gradient(circle at 85% 20%, rgba(115,87,246,.55), transparent 30%),
            radial-gradient(circle at 10% 90%, rgba(56,189,248,.18), transparent 30%),
            linear-gradient(125deg, #10152b, #20234b 65%, #34256b);
    }

    .kk-hero::after {
        content: "";
        position: absolute;
        width: 330px;
        height: 330px;
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 50%;
        right: -100px;
        bottom: -170px;
        box-shadow: 0 0 0 35px rgba(255,255,255,.025),
                    0 0 0 75px rgba(255,255,255,.02);
    }

    .kk-label {
        display: inline-block;
        padding: 9px 16px;
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 30px;
        background: rgba(255,255,255,.08);
        color: #c4b8ff;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .kk-hero h1 {
        max-width: 650px;
        margin: 24px 0;
        font-size: clamp(40px, 6vw, 68px);
        font-weight: 850;
        line-height: 1.1;
        letter-spacing: -2px;
    }

    .kk-gradient-text {
        background: linear-gradient(90deg, #a99aff, #55d5ff);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .kk-hero p {
        max-width: 550px;
        color: #c8cce0;
        font-size: 17px;
        line-height: 1.8;
    }

    .kk-primary-btn {
        display: inline-block;
        padding: 15px 25px;
        border-radius: 12px;
        background: linear-gradient(100deg, #8065ff, #4e9dff);
        color: white;
        text-decoration: none;
        font-weight: 700;
        box-shadow: 0 10px 30px rgba(99,102,241,.3);
        transition: .25s;
    }

    .kk-primary-btn:hover {
        color: white;
        transform: translateY(-4px);
        box-shadow: 0 15px 35px rgba(99,102,241,.4);
    }

    .kk-secondary-btn {
        display: inline-block;
        padding: 14px 22px;
        border: 1px solid rgba(255,255,255,.3);
        border-radius: 12px;
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: .25s;
    }

    .kk-secondary-btn:hover {
        background: white;
        color: var(--kk-dark);
    }

    .kk-hero-art {
        position: relative;
        min-height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .kk-code-card {
        width: min(100%, 390px);
        padding: 25px;
        border: 1px solid rgba(255,255,255,.16);
        border-radius: 22px;
        background: rgba(255,255,255,.09);
        backdrop-filter: blur(12px);
        box-shadow: 0 25px 70px rgba(0,0,0,.25);
        transform: rotate(-3deg);
    }

    .kk-code-dots span {
        display: inline-block;
        width: 9px;
        height: 9px;
        margin-right: 5px;
        border-radius: 50%;
        background: #ff7777;
    }

    .kk-code-dots span:nth-child(2) { background: #ffd166; }
    .kk-code-dots span:nth-child(3) { background: #4ade80; }

    .kk-code-line {
        margin-top: 18px;
        color: #d5d9f5;
        font-family: monospace;
        line-height: 2;
        font-size: 14px;
    }

    .kk-code-purple { color: #c4a7ff; }
    .kk-code-blue { color: #67d9ff; }
    .kk-code-green { color: #8cf0b1; }

    .kk-stats {
        position: relative;
        z-index: 2;
        margin-top: -35px;
    }

    .kk-stat-box {
        padding: 22px 12px;
        height: 100%;
        border: 1px solid #edf0fa;
        border-radius: 16px;
        background: white;
        text-align: center;
        box-shadow: 0 12px 35px rgba(25,35,80,.06);
    }

    .kk-stat-box h3 {
        margin-bottom: 4px;
        color: var(--kk-purple);
        font-size: 27px;
        font-weight: 800;
    }

    .kk-stat-box p {
        margin: 0;
        color: #777f96;
        font-size: 13px;
    }

    .kk-section {
        padding: 85px 0;
    }

    .kk-section-heading {
        max-width: 620px;
        margin: 0 auto 45px;
        text-align: center;
    }

    .kk-section-heading span {
        color: var(--kk-purple);
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .kk-section-heading h2 {
        margin: 12px 0;
        font-size: clamp(29px, 4vw, 40px);
        font-weight: 850;
        letter-spacing: -1px;
    }

    .kk-section-heading p {
        color: #788097;
        line-height: 1.7;
    }

    .kk-course-card {
        height: 100%;
        padding: 28px;
        border: 1px solid #edf0f8;
        border-radius: 20px;
        background: white;
        box-shadow: 0 10px 35px rgba(20,30,70,.045);
        transition: .3s ease;
    }

    .kk-course-card:hover {
        transform: translateY(-9px);
        border-color: #c9c0ff;
        box-shadow: 0 22px 45px rgba(50,50,100,.12);
    }

    .kk-course-icon {
        display: flex;
        width: 62px;
        height: 62px;
        align-items: center;
        justify-content: center;
        margin-bottom: 23px;
        border-radius: 17px;
        font-size: 29px;
    }

    .kk-icon-purple { background: #eeeaff; }
    .kk-icon-blue { background: #e5f6ff; }
    .kk-icon-orange { background: #fff0df; }

    .kk-course-card h3 {
        margin-bottom: 12px;
        font-size: 22px;
        font-weight: 800;
    }

    .kk-course-card p {
        min-height: 75px;
        color: #7b8296;
        line-height: 1.7;
    }

    .kk-course-price {
        margin: 22px 0;
        padding-top: 18px;
        border-top: 1px solid #edf0f6;
    }

    .kk-course-price small {
        display: block;
        margin-bottom: 5px;
        color: #8990a3;
    }

    .kk-course-price strong {
        color: var(--kk-purple);
        font-size: 25px;
        font-weight: 850;
    }

    .kk-course-link {
        display: block;
        padding: 12px;
        border-radius: 10px;
        background: #f0edff;
        color: #6247df;
        text-align: center;
        text-decoration: none;
        font-weight: 700;
        transition: .2s;
    }

    .kk-course-link:hover {
        background: var(--kk-purple);
        color: white;
    }

    .kk-benefits {
        background: white;
    }

    .kk-benefit-card {
        display: flex;
        gap: 16px;
        height: 100%;
        padding: 22px;
        border: 1px solid #edf0f8;
        border-radius: 16px;
    }

    .kk-benefit-icon {
        display: flex;
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #eeeaff;
        font-size: 22px;
    }

    .kk-benefit-card h4 {
        margin-bottom: 7px;
        font-size: 17px;
        font-weight: 800;
    }

    .kk-benefit-card p {
        margin: 0;
        color: #7b8296;
        font-size: 14px;
        line-height: 1.6;
    }

    .kk-cta {
        padding: 65px 25px;
        border-radius: 25px;
        background: linear-gradient(115deg, #27245b, #7053e9);
        color: white;
        text-align: center;
    }

    .kk-cta h2 {
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 850;
    }

    .kk-cta p {
        color: #ddd9ff;
    }

    .kk-footer {
        padding: 28px 0;
        background: #10152b;
        color: #aeb5cd;
        text-align: center;
        font-size: 14px;
    }

    @media (max-width: 767px) {
        .kk-hero { padding: 65px 0 75px; }
        .kk-hero-art { min-height: 260px; margin-top: 25px; }
        .kk-section { padding: 60px 0; }
        .kk-course-card p { min-height: auto; }
    }
</style>

<div class="kk-home">

    {{-- HERO --}}
    <section class="kk-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="kk-label">✦ PLATFORM BELAJAR DIGITAL</span>

                    <h1>
                        Saatnya Upgrade
                        <span class="kk-gradient-text">Skill Digitalmu.</span>
                    </h1>

                    <p>
                        Belajar coding dari nol hingga mampu membangun website
                        sendiri. Temukan potensi terbaikmu bersama KursusKu!
                    </p>

                    {{-- TOMBOL HERO --}}
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('enrollments.create') }}" class="kk-primary-btn">
                            Mulai Belajar Sekarang →
                        </a>

                        <a href="{{ route('enrollments.create') }}" class="kk-primary-btn">
                            Daftar Kursus →
                        </a>

                        <a href="#kursus" class="kk-secondary-btn">
                            Jelajahi Kursus
                        </a>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="kk-hero-art">
                        <div class="kk-code-card">
                            <div class="kk-code-dots">
                                <span></span><span></span><span></span>
                            </div>
                            <div class="kk-code-line">
                                <div><span class="kk-code-purple">const</span> future = {</div>
                                <div>&nbsp;&nbsp;skill: <span class="kk-code-green">'Coding'</span>,</div>
                                <div>&nbsp;&nbsp;dream: <span class="kk-code-green">'Developer'</span>,</div>
                                <div>&nbsp;&nbsp;success: <span class="kk-code-blue">true</span></div>
                                <div>};</div>
                                <br>
                                <div><span class="kk-code-purple">function</span> <span class="kk-code-blue">startLearning</span>() {</div>
                                <div>&nbsp;&nbsp;return <span class="kk-code-green">'Your Future Starts Now!'</span>;</div>
                                <div>}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATISTIK --}}
    <section class="kk-stats">
        <div class="container">
            <div class="row g-3">
                <div class="col-6 col-lg-3">
                    <div class="kk-stat-box">
                        <h3>3+</h3>
                        <p>Pilihan Kursus</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="kk-stat-box">
                        <h3>100%</h3>
                        <p>Belajar dari Dasar</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="kk-stat-box">
                        <h3>Praktis</h3>
                        <p>Fokus Praktik Coding</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="kk-stat-box">
                        <h3>Flexible</h3>
                        <p>Belajar Sesuai Ritmemu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PILIHAN KURSUS --}}
    <section class="kk-section" id="kursus">
        <div class="container">
            <div class="kk-section-heading">
                <span>OUR COURSES</span>
                <h2>Temukan Kursus Favoritmu</h2>
                <p>
                    Mulai dari dasar, bangun kemampuan, dan siapkan dirimu
                    untuk menghadapi dunia digital.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="kk-course-card">
                        <div class="kk-course-icon kk-icon-purple">💻</div>
                        <h3>Web Dasar</h3>
                        <p>
                            Pelajari HTML dan CSS untuk membuat halaman website
                            pertamamu dari nol.
                        </p>
                        <div class="kk-course-price">
                            <small>Biaya kursus</small>
                            <strong>Rp300.000</strong>
                        </div>
                        <a href="{{ route('enrollments.create') }}" class="kk-course-link">
                            Pilih Kursus →
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="kk-course-card">
                        <div class="kk-course-icon kk-icon-blue">⚙️</div>
                        <h3>PHP Dasar</h3>
                        <p>
                            Kenali variabel, kondisi, perulangan, dan fungsi
                            untuk membangun logika pemrograman.
                        </p>
                        <div class="kk-course-price">
                            <small>Biaya kursus</small>
                            <strong>Rp400.000</strong>
                        </div>
                        <a href="{{ route('enrollments.create') }}" class="kk-course-link">
                            Pilih Kursus →
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="kk-course-card">
                        <div class="kk-course-icon kk-icon-orange">🚀</div>
                        <h3>Laravel Dasar</h3>
                        <p>
                            Pelajari framework Laravel untuk membuat aplikasi
                            web modern dan dinamis.
                        </p>
                        <div class="kk-course-price">
                            <small>Biaya kursus</small>
                            <strong>Rp500.000</strong>
                        </div>
                        <a href="{{ route('enrollments.create') }}" class="kk-course-link">
                            Pilih Kursus →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN --}}
    <section class="kk-section kk-benefits">
        <div class="container">
            <div class="kk-section-heading">
                <span>WHY KURSUSKU?</span>
                <h2>Kenapa Belajar di KursusKu?</h2>
                <p>
                    Kami ingin membuat proses belajar teknologi terasa lebih
                    mudah, terarah, dan menyenangkan.
                </p>
            </div>

            <div class="row g-3">
                <div class="col-md-6 col-lg-4">
                    <div class="kk-benefit-card">
                        <div class="kk-benefit-icon">🎯</div>
                        <div>
                            <h4>Materi Terarah</h4>
                            <p>Belajar secara bertahap dari konsep dasar hingga praktik.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="kk-benefit-card">
                        <div class="kk-benefit-icon">💡</div>
                        <div>
                            <h4>Mudah Dipahami</h4>
                            <p>Materi dirancang agar pemula dapat mengikuti proses belajar.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="kk-benefit-card">
                        <div class="kk-benefit-icon">🛠️</div>
                        <div>
                            <h4>Belajar Praktik</h4>
                            <p>Asah kemampuan dengan mencoba langsung membuat program.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- AJAKAN DAFTAR --}}
    <section class="kk-section">
        <div class="container">
            <div class="kk-cta">
                <h2>Siap Memulai Perjalanan Digitalmu?</h2>
                <p class="mt-3 mb-4">
                    Jangan hanya punya mimpi. Mulai bangun kemampuanmu hari ini!
                </p>
                <a href="{{ route('enrollments.create') }}" class="kk-primary-btn">
                    Daftar Kursus Sekarang →
                </a>
            </div>
        </div>
    </section>

    <footer class="kk-footer">
        <div class="container">
            © {{ date('Y') }} KursusKu. Belajar, Berkembang, dan Berkarya.
        </div>
    </footer>

</div>
@endsection
