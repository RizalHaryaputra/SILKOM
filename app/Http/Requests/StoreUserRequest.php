<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('Admin');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name',

            // Aturan kondisional: Wajib jika role adalah 'Student'
            'student_id_number' => [
                'required_if:role,Student',
                'nullable',
                'string',
                'unique:students,student_id_number'
            ],
            'major' => 'required_if:role,Student|nullable|string|max:255',
            'faculty' => 'required_if:role,Student|nullable|string|max:255',
        ];
    }
}