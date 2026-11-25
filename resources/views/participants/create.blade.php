
@extends('layouts.app')

@section('title', 'Pendaftaran Peserta')

@section('content')

<style>
    .register-page {
        min-height: 80vh;
        padding: 45px 15px;
        background: linear-gradient(135deg, #f4f0ff, #eef5ff);
        border-radius: 20px;
    }

    .register-heading {
        text-align: center;
        margin-bottom: 30px;
    }

    .register-tag {
        display: inline-block;
        padding: 7px 17px;
        margin-bottom: 12px;
        color: #6d4bd1;
        background: #eee8ff;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .register-heading h2 {
        color: #25204a;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .register-heading p {
        color: #77758d;
        margin: 0;
    }

    .register-card {
        background: #fff;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(76, 60, 130, 0.09);
    }

    .register-card-header {
        padding: 24px 30px;
        color: #fff;
        background: linear-gradient(135deg, #7952d8, #526fe0);
    }

    .register-card-header h4 {
        font-weight: 800;
        margin-bottom: 5px;
    }

    .register-card-header small {
        color: rgba(255,255,255,0.85);
    }

    .register-card-body {
        padding: 30px;
    }

    .register-card-body .form-label {
        color: #403765;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .register-card-body .form-control {
        border: 1px solid #e4e0f0;
        border-radius: 10px;
        padding: 12px 14px;
        color: #39334f;
        background: #fff;
        transition: 0.2s;
    }

    .register-card-body .form-control:focus {
        border-color: #7952d8;
        box-shadow: 0 0 0 3px rgba(121, 82, 216, 0.12);
    }

    .register-card-body .form-control::placeholder {
        color: #aaa6ba;
    }

    .register-alert {
        border: none;
        border-radius: 10px;
        padding: 15px 18px;
    }

    .btn-register {
        color: #fff;
        background: linear-gradient(135deg, #7952d8, #526fe0);
        border: none;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-register:hover {
        color: #fff;
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .btn-register-back {
        color: #65558f;
        background: #f0edfa;
        border: 1px solid #e5def7;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-register-back:hover {
        color: #493779;
        background: #e8e2f8;
    }

    @media (max-width: 576px) {
        .register-page {
            padding: 25px 10px;
        }

        .register-card-header {
            padding: 22px;
        }

        .register-card-body {
            padding: 22px 17px;
        }

        .register-actions .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="register-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">

                <div class="register-heading">
                    <span class="register-tag">✦ JOIN KURSUSKU</span>

                    <h2>Form Pendaftaran</h2>

                    <p>
                        Lengkapi data dirimu untuk memulai perjalanan belajar bersama KursusKu.
                    </p>
                </div>

                <div class="card register-card">

                    <div class="register-card-header">
                        <h4>📝 Data Diri Peserta</h4>
                        <small>Silakan isi informasi diri dengan benar.</small>
                    </div>

                    <div class="register-card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger register-alert">
                                <strong>Pendaftaran belum berhasil.</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('participants.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="Masukkan email"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label">
                                    Nomor Telepon
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    class="form-control"
                                    value="{{ old('phone') }}"
                                    placeholder="Masukkan nomor telepon"
                                >
                            </div>

                            <div class="d-flex justify-content-between gap-2 flex-wrap register-actions">
                                <a href="{{ route('home') }}"
                                   class="btn btn-register-back">
                                    ← Kembali
                                </a>

                                <button type="submit" class="btn btn-register">
                                    ✓ Daftar Sekarang
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
