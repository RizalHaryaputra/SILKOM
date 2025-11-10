<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_kms_documents_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kms_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content'); // Untuk panduan [cite: 34]
            $table->string('category')->nullable(); // e.g., 'Maintenance', 'Network', 'Software'
            
            // Opsional: Lacak penulis (Admin/Staff)
            $table->foreignId('author_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes(); // Prosedur bisa usang
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kms_documents');
    }
};