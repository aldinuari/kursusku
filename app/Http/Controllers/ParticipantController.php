<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    // Menampilkan form pendaftaran peserta
    public function create()
    {
        return view('participants.create');
    }

    // Menyimpan data peserta
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:participants,email',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        Participant::create($data);

        return redirect()
            ->route('enrollments.create')
            ->with('success', 'Pendaftaran berhasil! Silakan pilih kursus.');
    }
}
