<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'computers' => ['required_without:components', 'array'],
            'components' => ['required_without:computers', 'array']
        ];
    }
}
