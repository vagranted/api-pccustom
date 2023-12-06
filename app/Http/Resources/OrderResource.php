<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class OrderResource extends JsonResource
{
    public string $type;
    public function __construct($resource)
    {
        parent::__construct($resource);
        switch ($resource->status->title) {
            case 'выбран':
                $this->type = 'cart';
                break;
        }
    }
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'sum' => $this->sum,
            'components' => ComponentResource::collection($this->components),
            'computers' => ComputerResource::collection($this->computers)
        ];
    }
}
