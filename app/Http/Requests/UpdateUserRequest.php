<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('Admin');
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id;
        $studentProfileId = $this->route('user')->studentProfile?->id;

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => 'nullable|string|min:8|confirmed', // Password opsional saat update
            'role' => 'required|string|exists:roles,name',

            // Aturan kondisional
            'student_id_number' => [
                'required_if:role,Student',
                'nullable',
                'string',
                Rule::unique('students')->ignore($studentProfileId),
            ],
            'major' => 'required_if:role,Student|nullable|string|max:255',
            'faculty' => 'required_if:role,Student|nullable|string|max:255',
        ];
    }
}