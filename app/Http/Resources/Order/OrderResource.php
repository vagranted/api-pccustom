<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\ComponentResource;
use App\Http\Resources\ComputerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->title,
            'sum' => $this->sum,
            'components' => ComponentResource::collection($this->components),
            'computers' => ComputerResource::collection($this->computers)
        ];
    }
}
