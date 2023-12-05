<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Models\Component;
use App\Models\Computer;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
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
        Log::debug($user->orders);
        $ordersAmount = $user->orders()->whereHas('status', function ($query) {
            $query->where('title', 'cart');
        })->count();

        if($ordersAmount > 0) {
            throw ValidationException::withMessages([
                'cart' => 'Cart has already been created'
            ]);
        }

        $payload = $request->validated();

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

        $resource = [];
        $resource['components'] = Component::whereHas('orders', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('title', 'cart');
            });
        })->get();

        $resource['computers'] = Computer::whereHas('orders', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('title', 'cart');
            });
        })->get();

        $resource['status'] = 'cart';
        return new OrderCollection(collect($resource));
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
