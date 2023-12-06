<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Component;
use App\Models\Computer;
use App\Models\Order;
use Illuminate\Http\Request;
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
        $user = $request->user();
        Log::debug($user);
        $order = $user->orders()
            ->whereHas('status', function ($query) {
                $query->where('title', 'выбран');
        })->first();

        if($order) {
            // ошибка
        }

        $order = Order::create(['user_id' => $user->id]);
        $payload = $request->validated();

        if(isset($payload['computers'])) {
            foreach ($payload['computers'] as $computerId) {
                SelectedProduct::create([
                    'order_id' => $order->id,
                    'selectable_type' => Computer::class,
                    'selectable_id' => $computerId
                ]);
            }
        }

        if(isset($payload['components'])) {
            foreach ($payload['components'] as $componentId) {
                SelectedProduct::create([
                    'order_id' => $order->id,
                    'selectable_type' => Component::class,
                    'selectable_id' => $componentId
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
