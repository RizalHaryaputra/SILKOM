<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_eis_kpis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eis_kpis', function (Blueprint $table) {
            $table->id();
            $table->string('kpi_key')->unique(); // e.g., 'total_asset_value', 'utilization_rate'
            $table->json('kpi_value')->nullable(); // Menyimpan data KPI
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eis_kpis');
    }
};