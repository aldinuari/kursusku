<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    // Menampilkan laporan enrollment
    public function index()
    {
        $enrollments = Enrollment::with([
            'participant',
            'course'
        ])
            ->latest()
            ->get();

        return view('enrollments.index', compact('enrollments'));
    }

    // Menampilkan form tambah enrollment
    public function create()
    {
        // Mengambil data participant berdasarkan nama
        $participants = Participant::orderBy('name')->get();

        // Mengambil kursus yang sedang dibuka
        $courses = Course::where('status', 'open')
            ->orderBy('code')
            ->get();

        return view('enrollments.create', compact(
            'participants',
            'courses'
        ));
    }

    // Menyimpan enrollment
    public function store(Request $request)
    {
        // Validasi data enrollment
        $data = $request->validate(
            [
                'participant_id' => [
                    'required',
                    'exists:participants,id',
                ],

                'course_id' => [
                    'required',
                    'exists:courses,id',
                    Rule::unique('enrollments')->where(
                        fn ($query) => $query->where(
                            'participant_id',
                            $request->participant_id
                        )
                    ),
                ],
            ],
            [
                'participant_id.required' =>
                    'Participant wajib dipilih.',

                'participant_id.exists' =>
                    'Participant tidak ditemukan.',

                'course_id.required' =>
                    'Course wajib dipilih.',

                'course_id.exists' =>
                    'Course tidak ditemukan.',

                'course_id.unique' =>
                    'Participant ini sudah terdaftar pada course tersebut.',
            ]
        );

        // Pastikan kursus masih dibuka
        $course = Course::where('id', $data['course_id'])
            ->where('status', 'open')
            ->first();

        if (!$course) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_id' => 'Course tidak tersedia atau sudah ditutup.',
                ]);
        }

        // Menentukan status awal enrollment
        $data['status'] = 'registered';

        // Menyimpan enrollment
        Enrollment::create($data);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment berhasil disimpan.');
    }
}
