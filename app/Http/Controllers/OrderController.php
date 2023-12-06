<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\Order\IndexOrderResource;
use App\Http\Resources\Order\OrderResource;
use App\Models\Component;
use App\Models\Computer;
use App\Models\Order;
use App\Models\OrderablePivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $qUser = $request->query('user');
        $this->authorize('viewAny', [Order::class, $qUser]);

        $qStatus = $request->query('status');
        $orders = Order::class;

        if(isset($user)) {
            $orders = (gettype($orders) === 'object')
                ? $orders->where('user_id', $user)
                : $orders::where('user_id', $user);
        }

        if(isset($qStatus)) {
            $orders = (gettype($orders) === 'object')
                ? $orders->whereHas()
                : $orders::where('user_id', $user);
        }

        $orders = (gettype($orders) === 'object')
            ? $orders->get()
            : $orders::all();

        return IndexOrderResource::collection($orders);
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
