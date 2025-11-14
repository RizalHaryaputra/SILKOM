<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBorrowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('Student');
    }

    public function rules(): array
    {
        return [
            'asset_id' => [
                'required',
                'integer',
                // Pastikan aset ada DAN statusnya 'Available'
                Rule::exists('assets', 'id')->where('status', 'Available')
            ],
            'borrowed_at' => 'required|date|after_or_equal:today',
            'purpose' => 'required|string|min:5|max:500', // <-- TAMBAHKAN INI
        ];
    }

    public function messages(): array
    {
        return [
            'asset_id.exists' => 'Aset yang Anda pilih tidak tersedia atau tidak ditemukan.',
            'borrowed_at.after_or_equal' => 'Tanggal peminjaman tidak boleh di masa lalu.',
            'purpose.required' => 'Tujuan peminjaman wajib diisi.', // <-- TAMBAHKAN INI
        ];
    }
}