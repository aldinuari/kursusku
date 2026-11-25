```php
<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

// ==========================================
// HALAMAN BERANDA
// ==========================================

Route::get('/', function () {
    return view('home');
})->name('home');


// ==========================================
// PENDAFTARAN PESERTA
// ==========================================

// Menampilkan form pendaftaran peserta
Route::get('/participants/create', [ParticipantController::class, 'create'])
    ->name('participants.create');

// Menyimpan data peserta
Route::post('/participants', [ParticipantController::class, 'store'])
    ->name('participants.store');


// ==========================================
// ENROLLMENT
// ==========================================

// Daftar enrollment
Route::get('/enrollments', [EnrollmentController::class, 'index'])
    ->name('enrollments.index');

// Form tambah enrollment
Route::get('/enrollments/create', [EnrollmentController::class, 'create'])
    ->name('enrollments.create');

// Simpan enrollment
Route::post('/enrollments', [EnrollmentController::class, 'store'])
    ->name('enrollments.store');


// ==========================================
// CEK KETERSEDIAAN KURSI
// ==========================================

Route::get('/courses/{id}/availability', function ($id) {

    $course = Course::withCount('enrollments')->find($id);

    if (!$course) {
        return response()->json([
            'message' => 'Kursus tidak ditemukan.',
        ], 404);
    }

    if ($course->status !== 'open') {
        return response()->json([
            'course' => $course->name,
            'remaining' => 0,
            'message' => 'Kursus tidak tersedia atau sudah ditutup.',
        ]);
    }

    $remaining = max(
        0,
        (int) $course->quota - $course->enrollments_count
    );

    return response()->json([
        'course' => $course->name,
        'remaining' => $remaining,
        'message' => $remaining > 0
            ? 'Kursi masih tersedia.'
            : 'Maaf, kursus sudah penuh.',
    ]);

})->name('courses.availability');


// ==========================================
// CRUD KURSUS
// ==========================================

// Daftar kursus
Route::get('/courses', [CourseController::class, 'index'])
    ->name('courses.index');

// Form tambah kursus
Route::get('/courses/create', [CourseController::class, 'create'])
    ->name('courses.create');

// Simpan kursus
Route::post('/courses', [CourseController::class, 'store'])
    ->name('courses.store');

// Detail kursus
Route::get('/courses/{course}', [CourseController::class, 'show'])
    ->name('courses.show');

// Form edit kursus
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])
    ->name('courses.edit');

// Perbarui kursus
Route::put('/courses/{course}', [CourseController::class, 'update'])
    ->name('courses.update');

// Hapus kursus
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])
    ->name('courses.destroy');
