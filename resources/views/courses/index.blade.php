
@extends('layouts.app')

@section('title', 'Daftar Kursus')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Kursus</h2>

        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            + Tambah Kursus
        </a>
    </div>

    {{-- Pesan berhasil --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Pesan error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tabel kursus --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
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
                @forelse($courses as $course)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $course->code }}</td>

                        <td>{{ $course->name }}</td>

                        <td>
                            Rp {{ number_format($course->fee, 0, ',', '.') }}
                        </td>

                        <td>{{ $course->quota }}</td>

                        <td>
                            {{ $course->start_date
                                ? $course->start_date->format('d-m-Y')
                                : '-' }}
                        </td>

                        <td>
                            @if($course->status == 'open')
                                <span class="badge bg-success">Dibuka</span>
                            @elseif($course->status == 'draft')
                                <span class="badge bg-warning text-dark">Draft</span>
                            @else
                                <span class="badge bg-secondary">Ditutup</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                {{-- Tombol Edit --}}
                                <a href="{{ route('courses.edit', $course->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('courses.destroy', $course->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            Belum ada data kursus.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
