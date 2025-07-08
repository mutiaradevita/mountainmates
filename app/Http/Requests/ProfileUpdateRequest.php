<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];

        if (Auth::user()?->role == 'pengelola') {
            $rules['company_name'] = ['required', 'string', 'max:255'];
            $rules['pic_name'] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }
}