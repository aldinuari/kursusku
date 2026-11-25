
@extends('layouts.app')

@section('title', 'Tambah Kursus - KursusKu')

@section('content')

<style>
    .course-page {
        min-height: 80vh;
        padding: 45px 15px;
        background: linear-gradient(135deg, #f4f0ff, #eef5ff);
        border-radius: 20px;
    }

    .course-card {
        background: #fff;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(76, 60, 130, 0.09);
    }

    .course-card-header {
        padding: 25px 30px;
        color: #fff;
        background: linear-gradient(135deg, #7952d8, #526fe0);
    }

    .course-card-header h4 {
        font-weight: 800;
        margin-bottom: 5px;
    }

    .course-card-header small {
        color: rgba(255,255,255,0.85);
    }

    .course-card-body {
        padding: 30px;
    }

    .course-card-body .form-label {
        color: #403765;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .course-card-body .form-control,
    .course-card-body .form-select {
        border: 1px solid #e4e0f0;
        border-radius: 10px;
        padding: 11px 13px;
        color: #39334f;
        background-color: #fff;
    }

    .course-card-body .form-control:focus,
    .course-card-body .form-select:focus {
        border-color: #7952d8;
        box-shadow: 0 0 0 3px rgba(121, 82, 216, 0.12);
    }

    .course-card-body .form-control::placeholder {
        color: #aaa6ba;
    }

    .course-card-body .form-control.is-invalid,
    .course-card-body .form-select.is-invalid {
        border-color: #dc3545;
    }

    .course-card-body .text-danger {
        display: inline-block;
        margin-top: 5px;
        font-size: 13px;
    }

    .course-alert {
        border: none;
        border-radius: 10px;
        padding: 15px 18px;
    }

    .btn-course-primary {
        color: #fff;
        background: linear-gradient(135deg, #7952d8, #526fe0);
        border: none;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-course-primary:hover {
        color: #fff;
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .btn-course-secondary {
        color: #65558f;
        background: #f0edfa;
        border: 1px solid #e5def7;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-course-secondary:hover {
        color: #493779;
        background: #e8e2f8;
    }

    @media (max-width: 576px) {
        .course-page {
            padding: 25px 10px;
        }

        .course-card-header {
            padding: 22px;
        }

        .course-card-body {
            padding: 22px 17px;
        }

        .course-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="course-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="text-center mb-4">
                    <span class="badge rounded-pill px-3 py-2 mb-2"
                          style="background:#eee8ff;color:#6d4bd1;">
                        ✦ KURSUSKU
                    </span>

                    <h2 class="fw-bold mb-2" style="color:#25204a;">
                        Tambah Kursus
                    </h2>

                    <p class="mb-0" style="color:#77758d;">
                        Tambahkan program pembelajaran baru untuk peserta KursusKu.
                    </p>
                </div>

                <div class="card course-card">
                    <div class="course-card-header">
                        <h4>📚 Tambah Kursus</h4>
                        <small>Masukkan informasi kursus baru</small>
                    </div>

                    <div class="course-card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger course-alert">
                                <strong>Data belum berhasil disimpan.</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('courses.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="code" class="form-label">Kode Kursus</label>
                                <input
                                    type="text"
                                    name="code"
                                    id="code"
                                    class="form-control"
                                    value="{{ old('code') }}"
                                    maxlength="20"
                                    placeholder="Contoh: WEB-101"
                                    required
                                >
                                @error('code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Kursus</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    minlength="3"
                                    maxlength="120"
                                    placeholder="Masukkan nama kursus"
                                    required
                                >
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    class="form-control"
                                    rows="4"
                                    maxlength="2000"
                                    placeholder="Deskripsi kursus (opsional)"
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fee" class="form-label">Biaya Kursus (Rp)</label>
                                    <input
                                        type="number"
                                        name="fee"
                                        id="fee"
                                        class="form-control"
                                        value="{{ old('fee') }}"
                                        min="0"
                                        required
                                    >
                                    @error('fee')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="quota" class="form-label">Kuota Peserta</label>
                                    <input
                                        type="number"
                                        name="quota"
                                        id="quota"
                                        class="form-control"
                                        value="{{ old('quota') }}"
                                        min="1"
                                        max="500"
                                        required
                                    >
                                    @error('quota')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input
                                    type="date"
                                    name="start_date"
                                    id="start_date"
                                    class="form-control"
                                    value="{{ old('start_date') }}"
                                    required
                                >
                                @error('start_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label">Status Kursus</label>
                                <select
                                    name="status"
                                    id="status"
                                    class="form-select"
                                    required
                                >
                                    <option value="">-- Pilih Status --</option>
                                    <option value="draft" @selected(old('status') == 'draft')>
                                        Draft
                                    </option>
                                    <option value="open" @selected(old('status') == 'open')>
                                        Dibuka
                                    </option>
                                    <option value="closed" @selected(old('status') == 'closed')>
                                        Ditutup
                                    </option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex gap-2 flex-wrap course-actions">
                                <button type="submit" class="btn btn-course-primary">
                                    ✓ Simpan Kursus
                                </button>

                                <a href="{{ route('courses.index') }}"
                                   class="btn btn-course-secondary">
                                    ← Kembali
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
