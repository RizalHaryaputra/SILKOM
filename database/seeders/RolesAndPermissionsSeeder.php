<?php
// database/seeders/RolesAndPermissionsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Reset cache izin
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Definisikan dan Buat Semua Izin (Permissions)
        $permissions = [
            // EIS
            'view-eis-dashboard',
            // MIS
            'view-reports',
            // Assets (TPS)
            'manage-assets', // CRUD Penuh untuk aset
            'report-damage', // Membuat laporan kerusakan
            // Borrowing (TPS)
            'approve-borrowing', // Menyetujui/menolak peminjaman
            'create-borrowing',   // Membuat permintaan peminjaman
            'view-own-borrowings', // Melihat riwayat peminjaman sendiri
            // Computer Usage (TPS)
            'log-computer-usage',
            // KMS
            'manage-kms-documents', // CRUD Penuh untuk dokumen KMS
            'view-kms-documents',   // Hanya melihat dokumen KMS
            // Asset Request (OAS)
            'create-asset-request',  // Membuat pengajuan aset baru
            'manage-asset-requests', // Menyetujui/menolak pengajuan
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // 3. Definisikan dan Buat Peran (Roles) lalu sinkronkan Izin

        // Role: EIS Lead
        $leadRole = Role::firstOrCreate(['name' => 'Lead', 'guard_name' => 'web']);
        $leadRole->syncPermissions([
            'view-eis-dashboard',
            'view-reports'
        ]);

        // Role: Admin Lab
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions([
            'view-reports',
            'manage-assets',
            'report-damage',
            'approve-borrowing',
            'manage-kms-documents',
            'view-kms-documents',
            'manage-asset-requests',
            'log-computer-usage'
        ]);

        // Role: Staff
        $staffRole = Role::firstOrCreate(['name' => 'Staff', 'guard_name' => 'web']);
        $staffRole->syncPermissions([
            'view-reports',
            'view-kms-documents',
            'log-computer-usage'
        ]);

        // Role: Student (Mahasiswa)
        $studentRole = Role::firstOrCreate(['name' => 'Student', 'guard_name' => 'web']);
        $studentRole->syncPermissions([
            'create-borrowing',
            'view-own-borrowings',
            'log-computer-usage',
            'create-asset-request'
        ]);
    }
}