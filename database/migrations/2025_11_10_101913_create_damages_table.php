<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_damages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('damages', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('asset_id')->nullable()->constrained('assets')->nullOnDelete();
            // admin_id adalah Admin Lab yang melaporkan kerusakan
            $table->foreignId('reporter_admin_id')->nullable()->constrained('users')->nullOnDelete();

            $table->text('description');
            $table->date('reported_at');
            $table->enum('repair_status', ['Reported', 'In Progress', 'Completed'])->default('Reported'); // 'Reported', 'In Progress', 'Completed'
            
            // Untuk EIS
            $table->decimal('repair_cost', 15, 2)->default(0);

            $table->timestamps();
            $table->softDeletes(); // Laporan kerusakan bisa salah input
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('damages');
    }
};