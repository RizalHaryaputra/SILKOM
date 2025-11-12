<?php

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
            $table->longText('content'); // Isi panduan

            // Enum untuk kategori dokumen KMS laboratorium komputer
            $table->enum('category', [
                'Maintenance',
                'Network',
                'Software',
                'Hardware',
                'Guideline',
                'Troubleshooting',
                'Safety',
                'Other',
            ])->default('Other');

            // gambar
            $table->string('cover_image')->nullable(); // Gambar utama / thumbnail

            // Penulis dokumen
            $table->string('author')->nullable();

            $table->timestamps();
            $table->softDeletes(); // Dokumen bisa dihapus tanpa hilang permanen
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kms_documents');
    }
};
