
<?php

use App\Http\Controllers\AuthController;
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
// AUTENTIKASI: LOGIN DAN LUPA PASSWORD
// ==========================================

Route::middleware('guest')->group(function () {

    // Halaman login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    // Proses login
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    // Halaman lupa password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
        ->name('password.request');

    // Mengirim link reset password
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Halaman membuat password baru
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
        ->name('password.reset');

    // Memproses password baru
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.update');
});


// ==========================================
// HALAMAN KHUSUS PENGGUNA YANG SUDAH LOGIN
// ==========================================

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');

    // Profil saya
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});


// ==========================================
// PENDAFTARAN PESERTA
// ==========================================

Route::get('/participants/create', [ParticipantController::class, 'create'])
    ->name('participants.create');

Route::post('/participants', [ParticipantController::class, 'store'])
    ->name('participants.store');


// ==========================================
// ENROLLMENT
// ==========================================

Route::get('/enrollments', [EnrollmentController::class, 'index'])
    ->name('enrollments.index');

Route::get('/enrollments/create', [EnrollmentController::class, 'create'])
    ->name('enrollments.create');

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
