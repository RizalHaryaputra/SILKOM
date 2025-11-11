<?php
// app/Models/Asset.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'description',
        'asset_image_path',
        'total_quantity',
        'status',
        'purchase_price',
    ];

    /**
     * Relasi ke riwayat peminjaman aset ini.
     */
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Relasi ke riwayat kerusakan aset ini.
     */
    public function damages(): HasMany
    {
        return $this->hasMany(Damage::class);
    }

    /**
     * Relasi ke riwayat penggunaan (jika ini komputer).
     */
    public function computerUsages(): HasMany
    {
        return $this->hasMany(ComputerUsage::class);
    }
}