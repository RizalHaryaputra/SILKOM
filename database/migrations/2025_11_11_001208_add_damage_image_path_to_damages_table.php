<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_damage_image_path_to_damages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('damages', function (Blueprint $table) {
            $table->string('damage_image_path')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('damages', function (Blueprint $table) {
            $table->dropColumn('damage_image_path');
        });
    }
};