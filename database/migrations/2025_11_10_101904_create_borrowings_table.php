<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_borrowings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();

            // user_id adalah peminjam (Mahasiswa/Staff)
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('asset_id')->nullable()->constrained('assets')->nullOnDelete();

            // admin_id adalah Admin Lab yang menyetujui
            $table->foreignId('approver_admin_id')->nullable()->constrained('users')->nullOnDelete();

            $table->text('purpose')->nullable();
            $table->dateTime('borrowed_at');
            $table->dateTime('returned_at')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Completed'])->default('Pending'); // 'Pending', 'Approved', 'Rejected', 'Completed'

            $table->timestamps();
            // Tidak pakai softDeletes, ini adalah log transaksional
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
