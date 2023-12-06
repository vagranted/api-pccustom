<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Component;
use App\Models\Computer;
use App\Models\Order;
use App\Models\OrderablePivot;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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
        $user = $request->user();
        $order = $user->orders()
            ->whereHas('status', function ($query) {
                $query->where('title', 'выбран');
        })->first();

        if($order) {
            throw ValidationException::withMessages([
                'cart' => 'Cart has already been created'
            ]);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'order_status_id' => 1
        ]);
        $payload = $request->validated();

        if(isset($payload['computers'])) {
            foreach ($payload['computers'] as $computerId) {
                OrderablePivot::create([
                    'order_id' => $order->id,
                    'orderable_type' => Computer::class,
                    'orderable_id' => $computerId
                ]);
            }
        }

        if(isset($payload['components'])) {
            foreach ($payload['components'] as $componentId) {
                OrderablePivot::create([
                    'order_id' => $order->id,
                    'orderable_type' => Component::class,
                    'orderable_id' => $componentId
                ]);
            }
        }

        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
