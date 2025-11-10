<?php
// app/Models/Student.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'student_id_number',
        'faculty',
        'major',
    ];

    /**
     * Relasi ke akun user (untuk login).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}