
<?php

use App\Models\Course;
use App\Models\Participant;
use App\Models\Enrollment;
use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// ==========================================
// HALAMAN BERANDA
// ==========================================

Route::get('/', function () {
    return view('home');
})->name('home');


// ==========================================
// FORMULIR PENDAFTARAN
// ==========================================

Route::get('/enrollments/create', function () {

    // Hanya tampilkan kursus yang statusnya open
    $courses = Course::where('status', 'open')
        ->withCount('enrollments')
        ->orderBy('name')
        ->get();

    return view('enrollments.create', [
        'courses' => $courses,
    ]);

})->name('enrollments.create');


// ==========================================
// CEK KETERSEDIAAN KURSI
// ==========================================

Route::get('/courses/{id}/availability', function ($id) {

    $course = Course::withCount('enrollments')
        ->find($id);

    if (!$course) {
        return response()->json([
            'message' => 'Kursus tidak ditemukan.',
        ], 404);
    }

    // Kursus yang tidak open tidak tersedia
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
// MEMPROSES PENDAFTARAN
// ==========================================

Route::post('/enrollments', function (Request $request) {

    // Validasi formulir
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'email', 'max:120'],
        'course_id' => ['required', 'integer', 'exists:courses,id'],
    ]);

    try {

        DB::transaction(function () use ($validated) {

            // Ambil kursus dan kunci baris selama transaksi
            $course = Course::whereKey($validated['course_id'])
                ->lockForUpdate()
                ->first();

            // Pastikan kursus ditemukan
            if (!$course) {
                throw new \RuntimeException(
                    'Kursus tidak ditemukan.'
                );
            }

            // Pastikan kursus berstatus open
            if ($course->status !== 'open') {
                throw new \RuntimeException(
                    'Kursus tidak tersedia atau sudah ditutup.'
                );
            }

            // Hitung jumlah peserta yang sudah terdaftar
            $enrolledCount = $course->enrollments()->count();

            // Periksa kapasitas kursus
            if ($enrolledCount >= $course->quota) {
                throw new \RuntimeException(
                    'Maaf, kursus sudah penuh.'
                );
            }

            // Cari peserta berdasarkan email.
            // Jika belum ada, buat peserta baru.
            $participant = Participant::updateOrCreate(
                [
                    'email' => $validated['email'],
                ],
                [
                    'name' => $validated['name'],
                ]
            );

            // Cegah peserta mendaftar kursus yang sama dua kali
            $alreadyRegistered = Enrollment::where(
                'participant_id',
                $participant->id
            )->where(
                'course_id',
                $course->id
            )->exists();

            if ($alreadyRegistered) {
                throw new \RuntimeException(
                    'Kamu sudah terdaftar pada kursus ini.'
                );
            }

            // Simpan pendaftaran ke database
            Enrollment::create([
                'participant_id' => $participant->id,
                'course_id' => $course->id,
                'status' => 'registered',
            ]);

        });

    } catch (\RuntimeException $e) {

        return back()
            ->withErrors([
                'course_id' => $e->getMessage(),
            ])
            ->withInput();

    }

    // Kembali ke formulir setelah berhasil
    return redirect()
        ->route('enrollments.create')
        ->with('success', 'Pendaftaran berhasil disimpan!');

})->name('enrollments.store');


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
