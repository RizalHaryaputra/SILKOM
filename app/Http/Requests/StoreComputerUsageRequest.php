<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreComputerUsageRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Pastikan hanya Staff (atau Admin) yang bisa input
        return $this->user()->hasAnyRole(['Staff', 'Admin']);
    }

    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id'),
            ],
            'asset_id' => [
                'required',
                'integer',
                // DIPERBARUI: Pastikan aset ada, kategori 'Computer', DAN status 'Available'
                Rule::exists('assets', 'id')
                    ->where('category', 'Computer')
                    ->where('status', 'Available'),
            ],
            'started_at' => 'required|date',
            'finished_at' => 'nullable|date|after_or_equal:started_at',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'Pengguna (Mahasiswa) yang dipilih tidak ditemukan.',
            'asset_id.exists' => 'Aset yang dipilih bukan komputer yang valid atau sedang tidak tersedia (mungkin sedang dipinjam/rusak).',
            'finished_at.after_or_equal' => 'Waktu selesai tidak boleh sebelum waktu mulai.',
        ];
    }
}
