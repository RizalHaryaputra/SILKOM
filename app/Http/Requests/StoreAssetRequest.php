<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Pastikan hanya user dengan peran 'Admin' yang bisa authorize
        return $this->user()->hasRole('Admin');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            // Validasi untuk gambar (opsional, maks 2MB)
            'asset_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'total_quantity' => 'required|integer|min:1',
            'status' => 'required|string|in:Available,Borrowed,Damaged',
            'purchase_price' => 'nullable|numeric|min:0',
        ];
    }
}