<?php
// app/Models/ComputerUsage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComputerUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asset_id',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    /**
     * Relasi ke user yang menggunakan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke aset (komputer) yang digunakan.
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}