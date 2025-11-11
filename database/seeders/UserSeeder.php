<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan transaction agar jika gagal, semua data akan di-rollback
        DB::transaction(function () {
            
            // --- Akun Sistem ---
            
            $pimpinan = User::create([
                'name' => 'Pimpinan Fakultas',
                'email' => 'pimpinan@lab.com',
                'password' => Hash::make('password') // Ganti password di production
            ]);
            $pimpinan->assignRole('Lead');
            
            $admin = User::create([
                'name' => 'Admin Lab Utama',
                'email' => 'admin@lab.com',
                'password' => Hash::make('password')
            ]);
            $admin->assignRole('Admin');

            $staff = User::create([
                'name' => 'Staff Lab',
                'email' => 'staff@lab.com',
                'password' => Hash::make('password')
            ]);
            $staff->assignRole('Staff');

            // --- Akun Mahasiswa (Tim Pengembang) ---
            // Data berdasarkan file MSI.pdf 

            // Rizal Haryaputra
            $rizalUser = User::create([
                'name' => 'Rizal Haryaputra',
                'email' => 'rizal.23051130013@student.uny.ac.id', // Contoh email
                'password' => Hash::make('password')
            ]);
            $rizalUser->assignRole('Student');
            Student::create([
                'user_id' => $rizalUser->id,
                'student_id_number' => '23051130013',
                'major' => 'Teknologi Informasi'
            ]);

            // Nabila Putri Aulaya Syifa
            $nabilaUser = User::create([
                'name' => 'Nabila Putri Aulaya Syifa',
                'email' => 'nabila.23051130020@student.uny.ac.id', // Contoh email
                'password' => Hash::make('password')
            ]);
            $nabilaUser->assignRole('Student');
            Student::create([
                'user_id' => $nabilaUser->id,
                'student_id_number' => '23051130020',
                'major' => 'Teknologi Informasi'
            ]);

            // Rigel Nadimaisy A.
            $rigelUser = User::create([
                'name' => 'Rigel Nadimaisy A.',
                'email' => 'rigel.23051130024@student.uny.ac.id', // Contoh email
                'password' => Hash::make('password')
            ]);
            $rigelUser->assignRole('Student');
            Student::create([
                'user_id' => $rigelUser->id,
                'student_id_number' => '23051130024',
                'major' => 'Teknologi Informasi'
            ]);

            // Rajendriya D.
            $rajaUser = User::create([
                'name' => 'Rajendriya D.',
                'email' => 'rajendriya.23051130010@student.uny.ac.id', // Contoh email
                'password' => Hash::make('password')
            ]);
            $rajaUser->assignRole('Student');
            Student::create([
                'user_id' => $rajaUser->id,
                'student_id_number' => '23051130010',
                'major' => 'Teknologi Informasi'
            ]);

        });
    }
}