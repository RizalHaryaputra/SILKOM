<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna (kecuali Pimpinan dan diri sendiri).
     */
    public function index()
    {
        $users = User::with(['roles', 'studentProfile'])
                    // Sembunyikan Pimpinan dari daftar
                    ->whereDoesntHave('roles', fn($q) => $q->where('name', 'Pimpinan'))
                    // Sembunyikan diri sendiri
                    ->where('id', '!=', auth()->id()) 
                    ->latest()
                    ->paginate(15);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     */
    public function create()
    {
        // Admin Lab hanya bisa membuat role Staff atau Student
        $roles = Role::get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Menyimpan pengguna baru.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($data) {
                // 1. Buat data di tabel 'users'
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);

                // 2. Berikan role
                $user->assignRole($data['role']);

                // 3. Jika role-nya Student, buat data di tabel 'students'
                if ($data['role'] === 'Student') {
                    $user->studentProfile()->create([
                        'student_id_number' => $data['student_id_number'],
                        'major' => $data['major'],
                        'faculty' => $data['faculty'],
                    ]);
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat pengguna. Terjadi kesalahan server.');
        }

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit pengguna.
     */
    public function edit(User $user)
    {
        // Admin Lab hanya bisa mengedit role Staff atau Student
        $roles = Role::get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Memperbarui pengguna.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($data, $user) {
                // 1. Update data di tabel 'users'
                $userData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                ];
                // Hanya update password jika diisi
                if (!empty($data['password'])) {
                    $userData['password'] = Hash::make($data['password']);
                }
                $user->update($userData);

                // 2. Sinkronkan role
                $user->syncRoles([$data['role']]);

                // 3. Logika untuk profil mahasiswa
                if ($data['role'] === 'Student') {
                    // Jika rolenya Student, buat atau update profilnya
                    $user->studentProfile()->updateOrCreate(
                        ['user_id' => $user->id], // Kriteria pencarian
                        [ // Data untuk di-update atau di-create
                            'student_id_number' => $data['student_id_number'],
                            'major' => $data['major'],
                            'faculty' => $data['faculty'],
                        ]
                    );
                } else if ($user->studentProfile) {
                    // Jika role diganti DARI Student KE Staff, hapus profil student
                    $user->studentProfile()->delete();
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui pengguna. Terjadi kesalahan server.');
        }

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna (Soft Delete).
     */
    public function destroy(User $user)
    {
        // Pastikan admin tidak menghapus dirinya sendiri (meskipun sudah difilter di index)
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        
        // Hapus profil student (jika ada) dan user
        DB::transaction(function () use ($user) {
            if ($user->studentProfile) {
                $user->studentProfile()->delete(); // Soft delete profil
            }
            $user->delete(); // Soft delete user
        });

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus (soft delete).');
    }
}