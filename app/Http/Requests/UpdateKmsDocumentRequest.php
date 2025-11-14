<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKmsDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('Admin');
    }

    public function rules(): array
    {
        $categories = [
            'Maintenance', 'Network', 'Software', 'Hardware',
            'Guideline', 'Troubleshooting', 'Safety', 'Other',
        ];

        return [
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:20',
            'category' => ['required', Rule::in($categories)],
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Opsional saat update
        ];
    }
}