<?php
// app/Models/AssetRequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'requester_user_id',
        'asset_name',
        'reason',
        'specification',
        'status',
    ];

    /**
     * Relasi ke user yang mengajukan.
     */
    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_user_id');
    }
}