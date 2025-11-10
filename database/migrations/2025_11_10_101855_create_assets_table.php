<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_assets_table.php

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
            $table->string('category'); // e.g., 'Computer', 'Peripheral', 'Other'
            $table->text('description')->nullable();
            $table->unsignedInteger('total_quantity')->default(1);
            $table->string('status')->default('Available'); // e.g., 'Available', 'Borrowed', 'Damaged'
            
            // Untuk EIS
            $table->decimal('purchase_price', 15, 2)->nullable();
            
            $table->timestamps();
            $table->softDeletes(); // Aset bisa di-nonaktifkan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};