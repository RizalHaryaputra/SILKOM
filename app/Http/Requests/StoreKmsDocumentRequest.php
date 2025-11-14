<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKmsDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Pastikan hanya Admin Lab yang bisa membuat
        return $this->user()->hasRole('Admin');
    }

    public function rules(): array
    {
        // Daftar enum yang valid dari migrasi Anda
        $categories = [
            'Maintenance', 'Network', 'Software', 'Hardware',
            'Guideline', 'Troubleshooting', 'Safety', 'Other',
        ];

        return [
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:20',
            'category' => ['required', Rule::in($categories)],
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            // 'author' akan kita isi otomatis di controller
        ];
    }
}