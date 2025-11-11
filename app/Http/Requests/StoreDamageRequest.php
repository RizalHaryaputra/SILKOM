<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDamageRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya Admin Lab yang bisa melaporkan kerusakan
        return $this->user()->hasRole('Admin');
    }

    public function rules(): array
    {
        return [
            // 'asset_id' harus ada dan merupakan aset yang valid di tabel 'assets'
            'asset_id' => 'required|integer|exists:assets,id',
            'description' => 'required|string',
            'reported_at' => 'required|date',
            // Gambar opsional, maks 2MB
            'damage_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            // Status perbaikan di-set otomatis di controller, tidak perlu divalidasi di sini
        ];
    }
}