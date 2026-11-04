
@extends('layouts.app')

@section('title', 'Beranda - KursusKu')

@section('content')
<div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
    <div class="container-fluid py-3">
        <span class="badge bg-success mb-3">Belajar Bersama KursusKu</span>

        <h1 class="display-5 fw-bold">
            Tingkatkan Kemampuan Digitalmu
        </h1>

        <p class="col-md-8 fs-5 text-secondary">
            Pilih kursus yang sesuai dengan kebutuhanmu dan
            mulai belajar pemrograman web dari dasar.
        </p>

        <a href="{{ route('enrollments.create') }}"
           class="btn btn-success btn-lg">
            Daftar Sekarang
        </a>
    </div>
</div>

<h2 class="mb-3">Pilihan Kursus</h2>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Web Dasar</h5>
                <p class="card-text">
                    Pelajari dasar HTML, CSS, dan pembuatan halaman web.
                </p>
                <h5 class="text-success">Rp300.000</h5>
                <a href="{{ route('enrollments.create') }}"
                   class="btn btn-outline-success mt-2">
                    Pilih Kursus
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">PHP Dasar</h5>
                <p class="card-text">
                    Kenali variabel, kondisi, perulangan, dan fungsi PHP.
                </p>
                <h5 class="text-success">Rp400.000</h5>
                <a href="{{ route('enrollments.create') }}"
                   class="btn btn-outline-success mt-2">
                    Pilih Kursus
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Laravel Dasar</h5>
                <p class="card-text">
                    Pelajari framework Laravel untuk membangun aplikasi web.
                </p>
                <h5 class="text-success">Rp500.000</h5>
                <a href="{{ route('enrollments.create') }}"
                   class="btn btn-outline-success mt-2">
                    Pilih Kursus
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
