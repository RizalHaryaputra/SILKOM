<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Aturan untuk tabel 'students'
            'student_id_number' => ['required', 'string', 'max:255', 'unique:' . Student::class],
            'major' => ['required', 'string', 'max:255'],
            'faculty' => ['required', 'string', 'max:255'],
        ]);

        // 4. GUNAKAN DB TRANSACTION
        try {
            DB::transaction(function () use ($request) {
                // Langkah A: Buat User
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                // Langkah B: Tetapkan Role 'Student'
                $user->assignRole('Student');

                // Langkah C: Buat Profil Mahasiswa
                $user->studentProfile()->create([
                    'student_id_number' => $request->student_id_number,
                    'major' => $request->major,
                    'faculty' => $request->faculty,
                ]);

                // Langkah D: Kirim event (opsional tapi bagus)
                event(new Registered($user));

                // Langkah E: Login user
                Auth::login($user);
            });
        } catch (\Exception $e) {
            // Jika gagal, kembali dengan error
            return redirect()->back()->with('error', 'Gagal mendaftar. Terjadi kesalahan server.');
        }

        return redirect(route('student.dashboard', absolute: false));
    }
}
