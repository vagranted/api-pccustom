<?php

namespace App\Http\Resources\Component;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartOrderResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'amount' => $this->orders()->count(),
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'type' => [
                'title' => $this->type->title
            ]
    ];
    }
}
