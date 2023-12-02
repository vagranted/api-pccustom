<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

class OrderCollection extends ResourceCollection
{
    public string $status;
    public string $sum;

    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->resource = $this->collectResource($resource);
        $this->status = $resource->first()->status->title;

        switch ($this->status) {
            case 'cart':
                $this->sum = Order::getSum('cart');
                break;
        }
    }
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->status,
            'sum' => $this->sum,
            'content' => [
//                'components' => $this->collection->get('component_orders')
            ]
        ];
    }
}
