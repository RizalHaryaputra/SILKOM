<?php
// app/Models/Damage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Damage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'asset_id',
        'reporter_admin_id',
        'description',
        'damage_image_path',
        'reported_at',
        'repair_status',
        'repair_cost',
    ];

    protected $casts = [
        'reported_at' => 'date',
    ];

    /**
     * Relasi ke aset yang rusak.
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Relasi ke admin yang melapor.
     */
    public function reporterAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_admin_id');
    }
}