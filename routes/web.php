```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

// Data kursus sementara
$courses = [
    [
        'id' => 1,
        'name' => 'Web Dasar',
        'price' => 300000,
        'capacity' => 20,
        'enrolled' => 5,
    ],
    [
        'id' => 2,
        'name' => 'PHP Dasar',
        'price' => 400000,
        'capacity' => 15,
        'enrolled' => 3,
    ],
    [
        'id' => 3,
        'name' => 'Laravel Dasar',
        'price' => 500000,
        'capacity' => 10,
        'enrolled' => 2,
    ],
];

// Halaman beranda
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman formulir pendaftaran
Route::get('/enrollments/create', function () use (&$courses) {
    return view('enrollments.create', [
        'courses' => $courses,
    ]);
})->name('enrollments.create');

// Mengecek sisa kursi melalui AJAX
Route::get('/courses/{id}/availability', function ($id) use (&$courses) {
    $course = collect($courses)->firstWhere('id', (int) $id);

    if (!$course) {
        return response()->json([
            'message' => 'Kursus tidak ditemukan.',
        ], 404);
    }

    return response()->json([
        'course' => $course['name'],
        'remaining' => max(
            0,
            $course['capacity'] - $course['enrolled']
        ),
    ]);
})->name('courses.availability');

// Memproses pendaftaran
Route::post('/enrollments', function (Request $request) use (&$courses) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'email', 'max:255'],
        'course_id' => ['required', 'integer', 'in:1,2,3'],
    ]);

    $index = array_search(
        (int) $validated['course_id'],
        array_column($courses, 'id')
    );

    if ($index === false) {
        return back()->withErrors([
            'course_id' => 'Kursus tidak ditemukan.',
        ])->withInput();
    }

    if ($courses[$index]['enrolled'] >= $courses[$index]['capacity']) {
        return back()->withErrors([
            'course_id' => 'Maaf, kursus sudah penuh.',
        ])->withInput();
    }

    $courses[$index]['enrolled']++;

    return redirect()
        ->route('enrollments.create')
        ->with('success', 'Pendaftaran berhasil diproses!');
})->name('enrollments.store');

// Menampilkan daftar kursus dari database
Route::get('/courses', [CourseController::class, 'index'])
    ->name('courses.index');

// Menampilkan formulir tambah kursus
Route::get('/courses/create', [CourseController::class, 'create'])
    ->name('courses.create');

// Menyimpan kursus baru ke database
Route::post('/courses', [CourseController::class, 'store'])
    ->name('courses.store');
// Form edit kursus
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])
    ->name('courses.edit');

// Menyimpan perubahan kursus
Route::put('/courses/{course}', [CourseController::class, 'update'])
    ->name('courses.update');

// Menghapus kursus
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])
    ->name('courses.destroy');