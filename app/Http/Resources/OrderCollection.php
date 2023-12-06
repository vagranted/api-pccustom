<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use App\Http\Resources\Component\OrderResource;

class OrderCollection extends ResourceCollection
{
    public string $status;
    public string $sum;
    public Collection $components;
    public Collection $computers;

    public function __construct($resource)
    {
        $this->components = $resource->get('components');
        $this->computers = $resource->get('computers');
        $this->status = $resource->get('status');

        switch ($this->status) {
            case 'cart':
                $this->sum = Order::getSum('cart');
                break;
        }
    }
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'sum' => $this->sum,
            'content' => [
                'components' => OrderResource::collection($this->components)
            ]
        ];
    }
}
