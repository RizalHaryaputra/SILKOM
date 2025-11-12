<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_asset_requests_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_requests', function (Blueprint $table) {
            $table->id();
            
            // user_id adalah yang mengajukan
            $table->foreignId('requester_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('asset_name');
            $table->text('specification')->nullable();
            $table->text('reason')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending'); // 'Pending', 'Approved', 'Rejected'

            $table->timestamps();
            $table->softDeletes(); // Pengajuan bisa dibatalkan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_requests');
    }
};