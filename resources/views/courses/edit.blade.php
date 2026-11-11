```php
@extends('layouts.app')

@section('title', 'Edit Kursus - KursusKu')

@section('content')

<style>
    .edit-page {
        min-height: 100vh;
        padding: 45px 0 70px;
        background:
            radial-gradient(circle at 5% 5%, rgba(128,101,255,.10), transparent 28%),
            #f5f6fc;
    }

    .edit-heading {
        max-width: 760px;
        margin: 0 auto 25px;
    }

    .edit-eyebrow {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 30px;
        background: #eeeaff;
        color: #7053e9;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.3px;
    }

    .edit-heading h1 {
        margin: 14px 0 8px;
        color: #10152b;
        font-size: clamp(28px, 4vw, 36px);
        font-weight: 850;
        letter-spacing: -1px;
    }

    .edit-heading p {
        margin: 0;
        color: #7b8296;
        line-height: 1.7;
    }

    .edit-card {
        max-width: 760px;
        margin: auto;
        overflow: hidden;
        border: 1px solid #edf0f8;
        border-radius: 22px;
        background: white;
        box-shadow: 0 20px 55px rgba(25,35,80,.08);
    }

    .edit-card-header {
        padding: 25px 32px;
        background: linear-gradient(110deg, #10152b, #30285f);
        color: white;
    }

    .edit-card-header h2 {
        margin: 0 0 7px;
        font-size: 21px;
        font-weight: 800;
    }

    .edit-card-header p {
        margin: 0;
        color: #c8cce0;
        font-size: 14px;
    }

    .edit-card-body {
        padding: 32px;
    }

    .edit-field {
        margin-bottom: 22px;
    }

    .edit-label {
        display: block;
        margin-bottom: 9px;
        color: #252b42;
        font-size: 14px;
        font-weight: 750;
    }

    .edit-input {
        display: block;
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

    textarea.edit-input {
        min-height: 115px;
        resize: vertical;
    }

    .edit-input:focus {
        border-color: #8065ff;
        background: white;
        box-shadow: 0 0 0 4px rgba(128,101,255,.12);
    }

    .edit-error {
        display: block;
        margin-top: 6px;
        color: #dc3545;
        font-size: 12px;
    }

    .edit-info {
        margin: 5px 0 24px;
        padding: 14px 16px;
        border-radius: 11px;
        background: #f3f6ff;
        color: #626d8b;
        font-size: 13px;
        line-height: 1.6;
    }

    .edit-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
    }

    .edit-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 13px 23px;
        border: none;
        border-radius: 11px;
        font-size: 14px;
        font-weight: 750;
        text-decoration: none;
        cursor: pointer;
        transition: .25s;
    }

    .edit-btn:hover {
        transform: translateY(-2px);
    }

    .edit-btn-save {
        background: linear-gradient(100deg, #8065ff, #4e9dff);
        color: white;
        box-shadow: 0 8px 20px rgba(99,102,241,.22);
    }

    .edit-btn-save:hover {
        color: white;
        box-shadow: 0 12px 25px rgba(99,102,241,.32);
    }

    .edit-btn-cancel {
        border: 1px solid #e1e5f0;
        background: white;
        color: #596078;
    }

    .edit-btn-cancel:hover {
        border-color: #8065ff;
        color: #7053e9;
        background: #f8f6ff;
    }

    @media (max-width: 576px) {
        .edit-page {
            padding-top: 28px;
        }

        .edit-card-body {
            padding: 23px 19px;
        }

        .edit-card-header {
            padding: 22px;
        }

        .edit-actions {
            flex-direction: column;
        }

        .edit-actions a,
        .edit-actions button {
            width: 100%;
        }
    }
</style>

<div class="edit-page">
    <div class="container">

        {{-- Judul halaman --}}
        <div class="edit-heading">
            <span class="edit-eyebrow">✦ KURSUSKU ACADEMY</span>

            <h1>Edit Kursus</h1>

            <p>
                Perbarui informasi kursus agar data yang ditampilkan
                selalu sesuai dan akurat.
            </p>
        </div>

        <div class="edit-card">

            {{-- Header form --}}
            <div class="edit-card-header">
                <h2>✎ Form Edit Kursus</h2>
                <p>
                    Ubah informasi kursus di bawah ini, kemudian simpan perubahan.
                </p>
            </div>

            <div class="edit-card-body">

                <form action="{{ route('courses.update', $course) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    {{-- Kode Kursus --}}
                    <div class="edit-field">
                        <label for="code" class="edit-label">
                            Kode Kursus
                        </label>

                        <input
                            type="text"
                            name="code"
                            id="code"
                            class="edit-input"
                            value="{{ old('code', $course->code) }}"
                            placeholder="Contoh: WEB-101"
                            required
                        >

                        @error('code')
                            <small class="edit-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Nama Kursus --}}
                    <div class="edit-field">
                        <label for="name" class="edit-label">
                            Nama Kursus
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="edit-input"
                            value="{{ old('name', $course->name) }}"
                            placeholder="Masukkan nama kursus"
                            required
                        >

                        @error('name')
                            <small class="edit-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="edit-field">
                        <label for="description" class="edit-label">
                            Deskripsi
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            class="edit-input"
                            placeholder="Tuliskan deskripsi kursus"
                        >{{ old('description', $course->description) }}</textarea>

                        @error('description')
                            <small class="edit-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Biaya --}}
                    <div class="edit-field">
                        <label for="fee" class="edit-label">
                            Biaya Kursus (Rp)
                        </label>

                        <input
                            type="number"
                            name="fee"
                            id="fee"
                            class="edit-input"
                            value="{{ old('fee', $course->fee) }}"
                            min="0"
                            placeholder="Masukkan biaya kursus"
                            required
                        >

                        @error('fee')
                            <small class="edit-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Kuota --}}
                    <div class="edit-field">
                        <label for="quota" class="edit-label">
                            Kuota Peserta
                        </label>

                        <input
                            type="number"
                            name="quota"
                            id="quota"
                            class="edit-input"
                            value="{{ old('quota', $course->quota) }}"
                            min="0"
                            placeholder="Masukkan jumlah kuota"
                            required
                        >

                        @error('quota')
                            <small class="edit-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="edit-field">
                        <label for="start_date" class="edit-label">
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            id="start_date"
                            class="edit-input"
                            value="{{ old('start_date', $course->start_date?->format('Y-m-d')) }}"
                        >

                        @error('start_date')
                            <small class="edit-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="edit-field">
                        <label for="status" class="edit-label">
                            Status Kursus
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="edit-input"
                            required
                        >
                            <option value="open"
                                @selected(old('status', $course->status) === 'open')>
                                Open
                            </option>

                            <option value="draft"
                                @selected(old('status', $course->status) === 'draft')>
                                Draft
                            </option>

                            <option value="closed"
                                @selected(old('status', $course->status) === 'closed')>
                                Closed
                            </option>
                        </select>

                        @error('status')
                            <small class="edit-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="edit-info">
                        💡 Pastikan seluruh informasi kursus sudah benar
                        sebelum menyimpan perubahan.
                    </div>

                    {{-- Tombol --}}
                    <div class="edit-actions">

                        <button type="submit" class="edit-btn edit-btn-save">
                            ✓ Simpan Perubahan
                        </button>

                        <a href="{{ route('courses.index') }}"
                           class="edit-btn edit-btn-cancel">
                            Batal
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
```