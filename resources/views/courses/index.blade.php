@extends('layouts.app')

@section('title', 'Daftar Kursus - KursusKu')

@section('content')

<style>
    .courses-page {
        min-height: 100vh;
        padding: 45px 0 70px;
        background:
            radial-gradient(circle at 5% 5%, rgba(128,101,255,.10), transparent 28%),
            #f5f6fc;
    }

    .courses-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }

    .courses-heading .eyebrow {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 30px;
        background: #eeeaff;
        color: #7053e9;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.3px;
    }

    .courses-heading h1 {
        margin: 13px 0 8px;
        color: #10152b;
        font-size: clamp(27px, 4vw, 36px);
        font-weight: 850;
        letter-spacing: -1px;
    }

    .courses-heading p {
        margin: 0;
        color: #7b8296;
        line-height: 1.7;
    }

    .courses-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .courses-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        padding: 12px 19px;
        border-radius: 11px;
        font-size: 14px;
        font-weight: 750;
        text-decoration: none;
        transition: .25s;
    }

    .courses-btn:hover {
        transform: translateY(-2px);
    }

    .courses-btn-register {
        color: white;
        background: linear-gradient(100deg, #8065ff, #4e9dff);
        box-shadow: 0 7px 18px rgba(99,102,241,.22);
    }

    .courses-btn-register:hover {
        color: white;
        box-shadow: 0 11px 23px rgba(99,102,241,.32);
    }

    .courses-btn-add {
        color: white;
        background: #10152b;
    }

    .courses-btn-add:hover {
        color: white;
        background: #29244f;
    }

    .courses-alert {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 18px rgba(25,35,80,.05);
    }

    .courses-card {
        overflow: hidden;
        border: 1px solid #edf0f8;
        border-radius: 18px;
        background: white;
        box-shadow: 0 15px 45px rgba(25,35,80,.07);
    }

    .courses-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        padding: 22px 25px;
        border-bottom: 1px solid #edf0f8;
    }

    .courses-card-header h3 {
        margin: 0;
        color: #10152b;
        font-size: 17px;
        font-weight: 800;
    }

    .courses-card-header span {
        color: #8990a3;
        font-size: 13px;
    }

    .courses-table-wrap {
        overflow-x: auto;
    }

    .courses-table {
        width: 100%;
        min-width: 950px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .courses-table thead th {
        padding: 16px 15px;
        background: #f8f9fd;
        color: #69718a;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        white-space: nowrap;
        border-bottom: 1px solid #edf0f8;
    }

    .courses-table tbody td {
        padding: 17px 15px;
        color: #424a62;
        font-size: 13px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f2f8;
    }

    .courses-table tbody tr:last-child td {
        border-bottom: none;
    }

    .courses-table tbody tr:hover {
        background: #fafaff;
    }

    .course-number {
        color: #9299aa;
        font-weight: 700;
    }

    .course-code {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 7px;
        background: #f0edff;
        color: #7053e9;
        font-size: 12px;
        font-weight: 800;
    }

    .course-name {
        color: #202741;
        font-weight: 750;
    }

    .course-fee {
        color: #202741;
        font-weight: 750;
        white-space: nowrap;
    }

    .course-status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
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

    .course-actions {
        display: flex;
        justify-content: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .course-action-btn {
        display: inline-block;
        padding: 7px 10px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .action-detail {
        color: #3978d8;
        background: #edf4ff;
        border-color: #dceaff;
    }

    .action-edit {
        color: #a87517;
        background: #fff7e6;
        border-color: #f8e8bf;
    }

    .action-delete {
        color: #d34d5c;
        background: #fff0f1;
        border-color: #ffdcdf;
    }

    .course-action-btn:hover {
        filter: brightness(.96);
        transform: translateY(-1px);
    }

    .courses-empty {
        padding: 45px 20px !important;
        color: #8990a3 !important;
        text-align: center;
    }

    .courses-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
        padding: 16px 20px;
        border: 1px solid #edf0f8;
        border-radius: 13px;
        background: white;
        color: #69718a;
        font-size: 13px;
    }

    .courses-total strong {
        color: #7053e9;
        font-size: 16px;
    }

    @media (max-width: 576px) {
        .courses-page {
            padding-top: 28px;
        }

        .courses-header {
            align-items: stretch;
        }

        .courses-actions {
            width: 100%;
        }

        .courses-actions a {
            flex: 1;
            text-align: center;
        }

        .courses-card-header {
            padding: 18px;
        }
    }
</style>

<div class="courses-page">
    <div class="container">

        {{-- Header halaman --}}
        <div class="courses-header">
            <div class="courses-heading">
                <span class="eyebrow">✦ KURSUSKU ACADEMY</span>

                <h1>Daftar Kursus</h1>

                <p>
                    Temukan dan kelola berbagai kursus untuk mengembangkan
                    kemampuan dan meraih masa depanmu.
                </p>
            </div>

            <div class="courses-actions">
                <a href="{{ route('enrollments.create') }}"
                   class="courses-btn courses-btn-register">
                    Daftar Kursus →
                </a>

                <a href="{{ route('courses.create') }}"
                   class="courses-btn courses-btn-add">
                    + Tambah Kursus
                </a>
            </div>
        </div>

        {{-- Pesan berhasil --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show courses-alert">
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                </button>
            </div>
        @endif

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="alert alert-danger courses-alert">
                <strong>Terjadi kesalahan:</strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Tabel daftar kursus --}}
        <div class="courses-card">

            <div class="courses-card-header">
                <h3>📚 Data Kursus Tersedia</h3>
                <span>Informasi kursus KursusKu</span>
            </div>

            <div class="courses-table-wrap">
                <table class="courses-table">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Kursus</th>
                            <th>Biaya</th>
                            <th>Kuota</th>
                            <th>Tanggal Mulai</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td>
                                    <span class="course-number">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                <td>
                                    <span class="course-code">
                                        {{ $course->code }}
                                    </span>
                                </td>

                                <td>
                                    <span class="course-name">
                                        {{ $course->name }}
                                    </span>
                                </td>

                                <td>
                                    <span class="course-fee">
                                        Rp {{ number_format($course->fee, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td>{{ $course->quota }} peserta</td>

                                <td>
                                    {{ $course->start_date?->format('d-m-Y') ?? '-' }}
                                </td>

                                <td>
                                    @if ($course->status === 'open')
                                        <span class="course-status status-open">
                                            ● Dibuka
                                        </span>
                                    @elseif ($course->status === 'draft')
                                        <span class="course-status status-draft">
                                            ● Draft
                                        </span>
                                    @else
                                        <span class="course-status status-closed">
                                            ● Ditutup
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="course-actions">

                                        <a href="{{ route('courses.show', $course) }}"
                                           class="course-action-btn action-detail">
                                            Detail
                                        </a>

                                        <a href="{{ route('courses.edit', $course) }}"
                                           class="course-action-btn action-edit">
                                            Edit
                                        </a>

                                        <form action="{{ route('courses.destroy', $course) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="course-action-btn action-delete">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="courses-empty">
                                    <div style="font-size: 35px; margin-bottom: 10px;">
                                        📚
                                    </div>

                                    <strong>Belum ada data kursus</strong>

                                    <p class="mb-0 mt-2">
                                        Silakan tambahkan kursus terlebih dahulu.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        {{-- Informasi jumlah data --}}
        <div class="courses-total">
            <span>Total kursus yang terdaftar</span>

            <strong>{{ $courses->count() }} Kursus</strong>
        </div>

    </div>
</div>

@endsection