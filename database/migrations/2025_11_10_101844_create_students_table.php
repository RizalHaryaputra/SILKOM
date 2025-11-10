<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_students_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            // Relasi One-to-One ke tabel users
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            
            $table->string('student_id_number')->unique(); // e.g., "23051130013"
            $table->string('faculty')->nullable(); // e.g., "Teknik"
            $table->string('major')->nullable(); // e.g., "Teknologi Informasi"
            
            $table->timestamps();
            $table->softDeletes(); // Profil mahasiswa bisa di-softdelete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};