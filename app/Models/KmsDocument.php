<?php
// app/Models/KmsDocument.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KmsDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'cover_image',
        'content',
        'category',
        'author',
    ];

    /**
     * Relasi ke user penulis dokumen.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }
}