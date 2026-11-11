@extends('layouts.app')

@section('title', 'Detail Kursus - KursusKu')

@section('content')

<style>
    .detail-page {
        min-height: 100vh;
        padding: 45px 0 70px;
        background:
            radial-gradient(circle at 5% 5%, rgba(128,101,255,.10), transparent 28%),
            #f5f6fc;
    }

    .detail-heading {
        margin-bottom: 28px;
    }

    .detail-eyebrow {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 30px;
        background: #eeeaff;
        color: #7053e9;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.3px;
    }

    .detail-heading h1 {
        margin: 14px 0 8px;
        color: #10152b;
        font-size: clamp(28px, 4vw, 36px);
        font-weight: 850;
        letter-spacing: -1px;
    }

    .detail-heading p {
        color: #7b8296;
        margin: 0;
    }

    .detail-card {
        max-width: 850px;
        margin: auto;
        overflow: hidden;
        border: 1px solid #edf0f8;
        border-radius: 22px;
        background: white;
        box-shadow: 0 20px 55px rgba(25,35,80,.08);
    }

    .detail-card-header {
        padding: 30px;
        background: linear-gradient(110deg, #10152b, #30285f);
        color: white;
    }

    .detail-card-header small {
        color: #bfc5e0;
        font-size: 12px;
        font-weight: 750;
        letter-spacing: 1.5px;
    }

    .detail-card-header h2 {
        margin: 10px 0 7px;
        font-size: 27px;
        font-weight: 850;
    }

    .detail-card-header p {
        margin: 0;
        color: #c8cce0;
        font-size: 14px;
    }

    .detail-card-body {
        padding: 30px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
    }

    .detail-item {
        padding: 19px;
        border: 1px solid #edf0f8;
        border-radius: 13px;
        background: #fbfcff;
    }

    .detail-item-full {
        grid-column: 1 / -1;
    }

    .detail-label {
        display: block;
        margin-bottom: 9px;
        color: #8990a3;
        font-size: 12px;
        font-weight: 750;
        text-transform: uppercase;
        letter-spacing: .7px;
    }

    .detail-value {
        color: #202741;
        font-size: 16px;
        font-weight: 750;
        overflow-wrap: anywhere;
    }

    .detail-description {
        color: #626d85;
        font-size: 14px;
        font-weight: 500;
        line-height: 1.8;
        white-space: pre-line;
    }

    .detail-fee {
        color: #7053e9;
        font-size: 20px;
        font-weight: 850;
    }

    .detail-status {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 800;
    }

    .status-open {
        color: #168451;
        background: #e5f8ee;
    }

    .status-draft {
        color: #737b90;
        background: #eef0f5;
    }

    .status-closed {
        color: #d34d5c;
        background: #fff0f1;
    }

    .detail-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
    }

    .detail-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 12px 22px;
        border-radius: 11px;
        font-size: 14px;
        font-weight: 750;
        text-decoration: none;
        transition: .25s;
    }

    .detail-btn:hover {
        transform: translateY(-2px);
    }

    .detail-btn-back {
        border: 1px solid #e1e5f0;
        background: white;
        color: #596078;
    }

    .detail-btn-back:hover {
        border-color: #8065ff;
        color: #7053e9;
        background: #f8f6ff;
    }

    .detail-btn-edit {
        background: linear-gradient(100deg, #8065ff, #4e9dff);
        color: white;
        box-shadow: 0 8px 20px rgba(99,102,241,.22);
    }

    .detail-btn-edit:hover {
        color: white;
        box-shadow: 0 12px 25px rgba(99,102,241,.32);
    }

    @media (max-width: 576px) {
        .detail-page {
            padding-top: 28px;
        }

        .detail-card-header,
        .detail-card-body {
            padding: 22px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-item-full {
            grid-column: auto;
        }

        .detail-actions {
            flex-direction: column;
        }

        .detail-actions a {
            width: 100%;
        }
    }
</style>

<div class="detail-page">
    <div class="container">

        {{-- Judul halaman --}}
        <div class="detail-heading">
            <span class="detail-eyebrow">✦ KURSUSKU ACADEMY</span>

            <h1>Detail Kursus</h1>

            <p>
                Informasi lengkap mengenai kursus yang kamu pilih.
            </p>
        </div>

        <div class="detail-card">

            {{-- Header detail --}}
            <div class="detail-card-header">
                <small>INFORMASI KURSUS</small>

                <h2>{{ $course->code }} - {{ $course->name }}</h2>

                <p>
                    Pelajari informasi dan ketersediaan kursus ini.
                </p>
            </div>

            {{-- Isi detail --}}
            <div class="detail-card-body">

                <div class="detail-grid">

                    <div class="detail-item">
                        <span class="detail-label">Kode Kursus</span>

                        <div class="detail-value">
                            {{ $course->code }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Nama Kursus</span>

                        <div class="detail-value">
                            {{ $course->name }}
                        </div>
                    </div>

                    <div class="detail-item detail-item-full">
                        <span class="detail-label">Deskripsi</span>

                        <div class="detail-value detail-description">
                            {{ $course->description ?: 'Belum ada deskripsi kursus.' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Biaya Kursus</span>

                        <div class="detail-fee">
                            Rp {{ number_format($course->fee, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Kuota</span>

                        <div class="detail-value">
                            {{ $course->quota }} peserta
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Tanggal Mulai</span>

                        <div class="detail-value">
                            {{ $course->start_date?->format('d-m-Y') ?? '-' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Status Kursus</span>

                        <div>
                            @if ($course->status === 'open')
                                <span class="detail-status status-open">
                                    ● Dibuka
                                </span>
                            @elseif ($course->status === 'draft')
                                <span class="detail-status status-draft">
                                    ● Draft
                                </span>
                            @else
                                <span class="detail-status status-closed">
                                    ● Ditutup
                                </span>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Tombol aksi --}}
                <div class="detail-actions">

                    <a href="{{ route('courses.index') }}"
                       class="detail-btn detail-btn-back">
                        ← Kembali ke Daftar Kursus
                    </a>

                    <a href="{{ route('courses.edit', $course) }}"
                       class="detail-btn detail-btn-edit">
                        ✎ Edit Kursus
                    </a>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection
