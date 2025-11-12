<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveBorrowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('Admin');
    }

    /**
     * Kita tidak menerima input form, jadi rules bisa kosong.
     * Otorisasi adalah kuncinya.
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}