<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['nullable', 'string', 'exists:order_statuses,title'],
            'computers' => ['nullable', 'array'],
            'components' => ['nullable', 'array']
        ];
    }
}
