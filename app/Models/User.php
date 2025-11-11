<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // <-- Impor Spatie

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles; // <-- Tambahkan SoftDeletes & HasRoles

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_photo_path',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // RELASI 
    
    /**
     * Relasi one-to-one ke profil mahasiswa.
     */
    public function studentProfile(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Relasi ke peminjaman yang dibuat oleh user ini.
     */
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class, 'user_id');
    }

    /**
     * Relasi ke penggunaan komputer oleh user ini.
     */
    public function computerUsages(): HasMany
    {
        return $this->hasMany(ComputerUsage::class, 'user_id');
    }

    /**
     * Relasi ke pengajuan aset oleh user ini.
     */
    public function assetRequests(): HasMany
    {
        return $this->hasMany(AssetRequest::class, 'requester_user_id');
    }
}