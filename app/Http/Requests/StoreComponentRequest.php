<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComponentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'exists:component_types,title'],
            'title' => ['required', 'string', 'max:64'],
            'price' => ['required', 'numeric']
        ];
    }
}
