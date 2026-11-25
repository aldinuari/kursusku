
@extends('layouts.app')

@section('title', 'Pendaftaran Kursus - KursusKu')

@section('content')
<style>
    .enroll-page {
        padding: 35px 0 65px;
        background:
            radial-gradient(circle at 5% 5%, rgba(128,101,255,.10), transparent 28%),
            #f5f6fc;
    }

    .enroll-heading {
        max-width: 650px;
        margin: 0 auto 30px;
        text-align: center;
    }

    .enroll-heading .eyebrow {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 30px;
        background: #eeeaff;
        color: #7053e9;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.5px;
    }

    .enroll-heading h1 {
        margin: 17px 0 10px;
        color: #10152b;
        font-size: clamp(30px, 5vw, 42px);
        font-weight: 850;
        letter-spacing: -1.5px;
    }

    .enroll-heading p {
        color: #7b8296;
        line-height: 1.7;
    }

    .enroll-card {
        max-width: 760px;
        margin: auto;
        overflow: hidden;
        border: 1px solid #edf0f8;
        border-radius: 22px;
        background: white;
        box-shadow: 0 20px 60px rgba(25,35,80,.08);
    }

    .enroll-card-header {
        padding: 25px 32px;
        background: linear-gradient(110deg, #10152b, #30285f);
        color: white;
    }

    .enroll-card-header h2 {
        margin: 0 0 6px;
        font-size: 20px;
        font-weight: 800;
    }

    .enroll-card-header p {
        margin: 0;
        color: #c8cce0;
        font-size: 14px;
    }

    .enroll-card-body {
        padding: 32px;
    }

    .enroll-label {
        display: block;
        margin-bottom: 9px;
        color: #252b42;
        font-size: 14px;
        font-weight: 700;
    }

    .enroll-input {
        width: 100%;
        min-height: 49px;
        padding: 12px 15px;
        border: 1px solid #e1e5f0;
        border-radius: 11px;
        background: #fbfcff;
        color: #252b42;
        outline: none;
        transition: .2s;
    }

    .enroll-input:focus {
        border-color: #8065ff;
        background: white;
        box-shadow: 0 0 0 4px rgba(128,101,255,.12);
    }

    .enroll-field {
        margin-bottom: 23px;
    }

    .enroll-hint {
        display: block;
        margin-top: 8px;
        color: #8990a3;
        font-size: 12px;
    }

    .enroll-submit {
        display: inline-block;
        padding: 13px 25px;
        border: none;
        border-radius: 11px;
        background: linear-gradient(100deg, #8065ff, #4e9dff);
        color: white;
        font-weight: 750;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(99,102,241,.22);
        transition: .25s;
    }

    .enroll-submit:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(99,102,241,.32);
    }

    .enroll-back {
        display: inline-block;
        padding: 12px 22px;
        border: 1px solid #e1e5f0;
        border-radius: 11px;
        background: white;
        color: #596078;
        font-weight: 650;
        text-decoration: none;
        transition: .2s;
    }

    .enroll-back:hover {
        border-color: #8065ff;
        color: #7053e9;
        background: #f8f6ff;
    }

    .enroll-info {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin-top: 22px;
        padding: 15px;
        border-radius: 12px;
        background: #f3f6ff;
        color: #626d8b;
        font-size: 13px;
        line-height: 1.6;
    }

    .enroll-info-icon {
        font-size: 20px;
    }

    @media (max-width: 576px) {
        .enroll-card-body {
            padding: 23px 19px;
        }

        .enroll-card-header {
            padding: 22px;
        }

        .enroll-actions {
            display: flex;
            flex-direction: column;
        }

        .enroll-actions a,
        .enroll-actions button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="enroll-page">
    <div class="container">

        <div class="enroll-heading">
            <span class="eyebrow">✦ JOIN KURSUSKU</span>

            <h1>Mulai Perjalanan Belajarmu!</h1>

            <p>
                Lengkapi formulir pendaftaran berikut dan pilih kursus
                yang sesuai dengan tujuan belajarmu.
            </p>
        </div>

        <div class="enroll-card">

            <div class="enroll-card-header">
                <h2>📝 Form Pendaftaran Kursus</h2>

                <p>
                    Pilih data peserta dan kursus untuk melanjutkan pendaftaran.
                </p>
            </div>

            <div class="enroll-card-body">

                {{-- PESAN BERHASIL --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- PESAN ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Pendaftaran belum berhasil.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM PENDAFTARAN --}}
                <form
                    action="{{ route('enrollments.store') }}"
                    method="POST"
                >
                    @csrf

                    {{-- PILIH PESERTA --}}
                    <div class="enroll-field">

                        <label for="participant_id" class="enroll-label">
                            Nama Lengkap
                        </label>

                        <select
                            name="participant_id"
                            id="participant_id"
                            class="enroll-input"
                            required
                        >
                            <option value="">
                                -- Pilih Peserta --
                            </option>

                            @forelse ($participants as $participant)
                                <option
                                    value="{{ $participant->id }}"
                                    @selected(old('participant_id') == $participant->id)
                                >
                                    {{ $participant->name }}
                                </option>
                            @empty
                                <option value="" disabled>
                                    Belum ada peserta terdaftar
                                </option>
                            @endforelse
                        </select>

                        @error('participant_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                        <small class="enroll-hint">
                            Pilih nama peserta yang sudah terdaftar.
                        </small>

                    </div>

                    {{-- PILIH KURSUS --}}
                    <div class="enroll-field">

                        <label for="course_id" class="enroll-label">
                            Pilih Kursus
                        </label>

                        <select
                            name="course_id"
                            id="course_id"
                            class="enroll-input"
                            required
                        >
                            <option value="">
                                -- Pilih Kursus --
                            </option>

                            @forelse ($courses as $course)
                                <option
                                    value="{{ $course->id }}"
                                    @selected(old('course_id') == $course->id)
                                >
                                    {{ $course->code }}
                                </option>
                            @empty
                                <option value="" disabled>
                                    Belum ada kursus tersedia
                                </option>
                            @endforelse
                        </select>

                        @error('course_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                        <small class="enroll-hint">
                            Pilih salah satu kursus yang tersedia.
                        </small>

                    </div>

                    {{-- INFORMASI --}}
                    <div class="enroll-info">

                        <span class="enroll-info-icon">💡</span>

                        <span>
                            Pastikan nama peserta dan pilihan kursus
                            sudah benar sebelum mengirim formulir
                            pendaftaran.
                        </span>

                    </div>

                    {{-- TOMBOL --}}
                    <div class="d-flex flex-wrap gap-3 mt-4 enroll-actions">

                        <button
                            type="submit"
                            class="enroll-submit"
                        >
                            Kirim Pendaftaran →
                        </button>

                        <a
                            href="{{ url('/') }}"
                            class="enroll-back"
                        >
                            ← Kembali ke Beranda
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
