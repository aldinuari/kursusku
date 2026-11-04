```php
@extends('layouts.app')

@section('title', 'Tambah Kursus')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Tambah Kursus Baru</h2>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Kode Kursus</label>
            <input type="text" name="code" class="form-control"
                value="{{ old('code') }}" required>
            @error('code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Kursus</label>
            <input type="text" name="name" class="form-control"
                value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Biaya</label>
            <input type="number" name="fee" class="form-control"
                value="{{ old('fee', 0) }}" min="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kuota</label>
            <input type="number" name="quota" class="form-control"
                value="{{ old('quota', 20) }}" min="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control"
                value="{{ old('start_date') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="draft">Draft</option>
                <option value="open">Open</option>
                <option value="closed">Closed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Kursus
        </button>

        <a href="{{ route('courses.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
```