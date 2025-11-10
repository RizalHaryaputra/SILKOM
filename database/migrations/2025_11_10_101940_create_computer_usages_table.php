<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_computer_usages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('computer_usages', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            // Logika bisnis akan memastikan asset_id merujuk ke 'Computer'
            $table->foreignId('asset_id')->nullable()->constrained('assets')->nullOnDelete();

            $table->dateTime('started_at');
            $table->dateTime('finished_at')->nullable();

            $table->timestamps();
            // Tidak pakai softDeletes, ini adalah log transaksional
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computer_usages');
    }
};