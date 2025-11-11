<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDamageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('Admin');
    }

    public function rules(): array
    {
        return [
            // 'asset_id' dan 'reported_at' biasanya tidak diubah
            'asset_id' => 'required|integer|exists:assets,id',
            'description' => 'required|string',
            'reported_at' => 'required|date',
            
            // Gambar opsional saat update
            'damage_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            // Ini adalah field penting untuk update
            'repair_status' => 'required|string|in:Reported,In Progress,Completed',
            'repair_cost' => 'nullable|numeric|min:0',
        ];
    }
}