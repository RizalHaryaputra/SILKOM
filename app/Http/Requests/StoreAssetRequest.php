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
            'category' => 'required|in:Computer,Peripheral,Networking,Storage,Software,Furniture,Other',
            'description' => 'nullable|string',
            // Validasi untuk gambar (opsional, maks 2MB)
            'asset_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:Available,Borrowed,Damaged',
            'purchase_price' => 'nullable|numeric|min:0',
        ];
    }
}
