<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                $user->update(['google_id' => $googleUser->id]);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(24)),
                ]);

                $user->assignRole('Student');

                $user->studentProfile()->create([
                    'student_id_number' => '-',
                    'major' => '-',
                    'faculty' => '-',
                ]);
            }

            Auth::login($user, true);

            request()->session()->regenerate();

            return $this->redirectBasedOnRole($user);
        } catch (\Exception $e) {
            dd($e->getMessage()); 
            return redirect('/login')->with('error', 'Gagal login via Google: ' . $e->getMessage());
        }
    }

    protected function redirectBasedOnRole($user)
    {
        // Logika redirect sesuai rute di web.php
        if ($user->hasRole('Admin')) return redirect()->route('admin.dashboard');
        if ($user->hasRole('Staff')) return redirect()->route('staff.dashboard');
        if ($user->hasRole('Lead')) return redirect()->route('lead.dashboard');
        return redirect()->route('student.dashboard');
    }
}
