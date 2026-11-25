
@extends('layouts.app')

@section('content')

<style>
    .enrollment-page {
        min-height: 80vh;
        padding: 45px 15px;
        background: linear-gradient(135deg, #f4f0ff, #eef5ff);
        border-radius: 20px;
    }

    .enrollment-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .enrollment-tag {
        display: inline-block;
        color: #6d4bd1;
        background: #eee8ff;
        padding: 7px 17px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .enrollment-header h2 {
        color: #25204a;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .enrollment-header p {
        color: #77758d;
        margin: 0;
    }

    .enrollment-card {
        background: #fff;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 10px 35px rgba(76, 60, 130, 0.09);
    }

    .enrollment-card-title {
        color: #30265e;
        font-size: 19px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .enrollment-card-description {
        color: #88869b;
        font-size: 14px;
        margin-bottom: 22px;
    }

    .btn-enrollment {
        display: inline-block;
        color: #fff;
        background: linear-gradient(135deg, #7952d8, #526fe0);
        border: none;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-enrollment:hover {
        color: #fff;
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .enrollment-table-wrapper {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #eeeaf7;
    }

    .enrollment-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        min-width: 650px;
    }

    .enrollment-table thead {
        background: #f2efff;
    }

    .enrollment-table th {
        color: #59449b;
        font-size: 13px;
        font-weight: 700;
        padding: 16px 14px;
        border: none;
        white-space: nowrap;
    }

    .enrollment-table td {
        color: #55536b;
        padding: 16px 14px;
        border-top: 1px solid #f0edf7;
        vertical-align: middle;
    }

    .enrollment-table tbody tr:hover {
        background: #faf9ff;
    }

    .number-badge {
        display: inline-flex;
        width: 29px;
        height: 29px;
        align-items: center;
        justify-content: center;
        color: #6d4bd1;
        background: #eee8ff;
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
    }

    .participant-name {
        color: #30265e;
        font-weight: 700;
    }

    .course-name {
        color: #5264c9;
        font-weight: 600;
    }

    .date-text {
        white-space: nowrap;
        font-size: 14px;
    }

    .status-badge {
        display: inline-block;
        color: #16845b;
        background: #e4f8ef;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .empty-enrollment {
        text-align: center;
        padding: 35px 15px !important;
        color: #9290a3 !important;
    }

    .success-message {
        border: none;
        border-radius: 10px;
        background: #e4f8ef;
        color: #16845b;
        padding: 13px 17px;
        margin-bottom: 22px;
    }

    @media (max-width: 576px) {
        .enrollment-page {
            padding: 30px 10px;
        }

        .enrollment-card {
            padding: 18px 13px;
        }

        .enrollment-header h2 {
            font-size: 25px;
        }
    }
</style>

<div class="enrollment-page">

    <div class="enrollment-header">
        <span class="enrollment-tag">✦ KURSUSKU</span>
        <h2>Daftar Enrollment</h2>
        <p>Kelola dan lihat daftar peserta yang telah mendaftar kursus.</p>
    </div>

    <div class="container">

        @if (session('success'))
            <div class="alert success-message">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="enrollment-card">

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                <div>
                    <div class="enrollment-card-title">
                        📋 Data Pendaftaran
                    </div>
                    <div class="enrollment-card-description mb-0">
                        Informasi peserta dan kursus yang dipilih.
                    </div>
                </div>

                <a href="{{ route('enrollments.create') }}"
                   class="btn-enrollment">
                    + Tambah Enrollment
                </a>
            </div>

            <div class="enrollment-table-wrapper">
                <table class="enrollment-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Nama Kursus</th>
                            <th>Tanggal Mulai</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($enrollments as $enrollment)
                            <tr>
                                <td>
                                    <span class="number-badge">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                <td>
                                    <span class="participant-name">
                                        {{ $enrollment->participant->name ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="course-name">
                                        {{ $enrollment->course->name ?? '-' }}
                                    </span>
                                </td>

                                <td class="date-text">
                                    {{ $enrollment->course && $enrollment->course->start_date
                                        ? $enrollment->course->start_date->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <span class="status-badge">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-enrollment">
                                    Belum ada data pendaftaran kursus.
                                    <br>
                                    Silakan klik tombol Tambah Enrollment untuk memulai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
