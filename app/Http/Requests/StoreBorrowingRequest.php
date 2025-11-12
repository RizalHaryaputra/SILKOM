<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBorrowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Pastikan hanya user dengan peran 'Student' yang bisa membuat request
        return $this->user()->hasRole('Student');
    }

    public function rules(): array
    {
        return [
            'asset_id' => [
                'required',
                'integer',
                // Aturan validasi yang sangat penting:
                // 1. Aset harus ada di tabel 'assets'
                // 2. Status aset tersebut HARUS 'Available'
                Rule::exists('assets', 'id')->where('status', 'Available')
            ],
            'borrowed_at' => 'required|date|after_or_equal:today',
            'purpose' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'asset_id.exists' => 'Aset yang Anda pilih tidak tersedia atau tidak ditemukan.',
            'borrowed_at.after_or_equal' => 'Tanggal peminjaman tidak boleh di masa lalu.',
        ];
    }
}