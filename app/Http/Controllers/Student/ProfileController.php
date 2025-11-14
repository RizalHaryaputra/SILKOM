<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentProfileRequest;
use App\Http\Requests\UpdateStudentPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        // Ambil user yang login beserta relasi studentProfile-nya
        $user = auth()->user()->load('studentProfile');
        return view('student.profile.edit', compact('user'));
    }

    /**
     * Memperbarui detail profil (Form 1).
     */
    public function updateDetails(UpdateStudentProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        try {
            DB::transaction(function () use ($user, $data, $request) {
                // 1. Update tabel 'users' (Nama, Email)
                $userData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                ];

                // 2. Cek jika ada upload foto profil baru
                if ($request->hasFile('photo')) {
                    // Hapus foto lama jika ada
                    if ($user->profile_photo_path) {
                        Storage::disk('public')->delete($user->profile_photo_path);
                    }
                    // Simpan foto baru
                    $userData['profile_photo_path'] = $request->file('photo')->store('avatars', 'public');
                }
                
                $user->update($userData);

                // 3. Update tabel 'students' (NIM, Jurusan, Fakultas)
                $user->studentProfile()->update([
                    'student_id_number' => $data['student_id_number'],
                    'major' => $data['major'],
                    'faculty' => $data['faculty'],
                ]);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil. Terjadi kesalahan server.');
        }

        return redirect()->route('student.profile.edit')->with('status', 'Profil berhasil diperbarui!');
    }

    /**
     * Memperbarui password (Form 2).
     */
    public function updatePassword(UpdateStudentPasswordRequest $request)
    {
        $user = auth()->user();
        
        // Validasi (termasuk cek password lama) sudah ditangani oleh UpdateStudentPasswordRequest
        
        // Update password baru
        $user->update([
            'password' => Hash::make($request->validated('password'))
        ]);

        return redirect()->route('student.profile.edit')->with('status', 'Password berhasil diubah!');
    }
}