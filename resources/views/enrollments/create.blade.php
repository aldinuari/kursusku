
@extends('layouts.app')

@section('title', 'Pendaftaran Kursus - KursusKu')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="mb-2">Form Pendaftaran Kursus</h2>
                <p class="text-secondary">
                    Isi data berikut untuk mendaftar di KursusKu.
                </p>

                <form action="{{ route('enrollments.store') }}"
                      method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Nama Lengkap
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="course_id" class="form-label">
                            Pilih Kursus
                        </label>

                        <select id="course_id"
                                name="course_id"
                                class="form-select"
                                required>
                            <option value="">-- Pilih Kursus --</option>

                            @foreach ($courses as $course)
                                <option value="{{ $course['id'] }}"
                                    @selected(old('course_id') == $course['id'])>
                                    {{ $course['name'] }} -
                                    Rp{{ number_format($course['price'], 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>

                        @error('course_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="availability"
                         class="alert alert-secondary"
                         role="status"
                         aria-live="polite">
                        Pilih kursus untuk melihat sisa kursi.
                    </div>

                    <button type="submit" class="btn btn-success">
                        Kirim Pendaftaran
                    </button>

                    <a href="{{ route('home') }}"
                       class="btn btn-outline-secondary">
                        Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
