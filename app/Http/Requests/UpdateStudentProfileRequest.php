<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // Izinkan jika user login
    }

    public function rules(): array
    {
        $userId = auth()->id();
        $studentProfileId = auth()->user()->studentProfile?->id;

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'student_id_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('students')->ignore($studentProfileId),
            ],
            'major' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}