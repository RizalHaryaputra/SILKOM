<?php
// app/Models/EisKpi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EisKpi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpi_key',
        'kpi_value',
    ];

    protected $casts = [
        'kpi_value' => 'array', // Casting JSON ke array PHP secara otomatis
    ];
}