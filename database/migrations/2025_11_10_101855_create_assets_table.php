<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Enum untuk kategori aset laboratorium komputer
            $table->enum('category', [
                'Computer',
                'Peripheral',
                'Networking',
                'Storage',
                'Software',
                'Furniture',
                'Other',
            ])->default('Other');

            $table->text('description')->nullable();

            // Enum untuk status aset
            $table->enum('status', [
                'Available',
                'Borrowed',
                'Damaged',
            ])->default('Available');

            $table->decimal('purchase_price', 15, 2)->nullable(); // Untuk keperluan EIS

            $table->timestamps();
            $table->softDeletes(); // Aset bisa di-nonaktifkan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
