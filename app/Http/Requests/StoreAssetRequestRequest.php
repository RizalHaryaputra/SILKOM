<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Izinkan jika user adalah Staff
        return $this->user()->hasRole('Staff');
    }

    public function rules(): array
    {
        return [
            'asset_name' => 'required|string|max:255',
            'specifications' => 'nullable|string|max:1000',
            'reason' => 'required|string|min:10|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'asset_name.required' => 'Nama alat tidak boleh kosong.',
            'reason.required' => 'Alasan pengajuan tidak boleh kosong.',
            'reason.min' => 'Alasan pengajuan minimal harus 10 karakter.',
        ];
    }
}