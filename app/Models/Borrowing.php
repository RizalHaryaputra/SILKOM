<?php
// app/Models/Borrowing.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asset_id',
        'approver_admin_id',
        'borrowed_at',
        'returned_at',
        'status',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    /**
     * Relasi ke user peminjam.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke admin yang menyetujui.
     */
    public function approverAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_admin_id');
    }

    /**
     * Relasi ke aset yang dipinjam.
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}