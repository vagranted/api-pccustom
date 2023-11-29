<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'password.regex' => 'The password field must contain the characters A-Z, 0-9, %, _, $, #, or @.'
        ];
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'min:6', 'max:32', 'alpha_dash', 'unique:users,login'],
            'password' => ['required', 'string', 'min:8', 'max:32', 'regex:/^[0-9A-z%_$#@]+$/', 'confirmed'],
        ];
    }
}
