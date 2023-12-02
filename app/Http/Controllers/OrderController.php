<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Models\Component;
use App\Models\Computer;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        //
    }

    public function store(StoreOrderRequest $request)
    {
        $payload = $request->validated();
        $user = $request->user();

        if(isset($payload['computers'])) {
            foreach ($payload['computers'] as $computerId) {
                Order::create([
                    'user_id' => $user->id,
                    'orderable_id' => $computerId,
                    'orderable_type' => Computer::class
                ]);
            }
        }

        if(isset($payload['components'])) {
            foreach ($payload['components'] as $componentId) {
                Order::create([
                    'user_id' => $user->id,
                    'orderable_id' => $computerId,
                    'orderable_type' => Component::class
                ]);
            }
        }

        $resources = [];
        $resources['component_orders'] = Order::whereHas('status', function ($query) {
            $query->where('title', 'cart');
        })
            ->where('orderable_type', Component::class)
            ->get();
        $resources['computer_orders'] = Order::whereHas('status', function ($query) {
            $query->where('title', 'cart');
        })
            ->where('orderable_type', Computer::class)
            ->get();
        return new OrderCollection(collect($resources));
    }

    public function show(Order $order)
    {
        //
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
