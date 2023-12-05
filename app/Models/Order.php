<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\ExecutionStatus;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }


//    public static function getSum(string $status, $orderNumber = null)
//    {
//        $status = OrderStatus::where('title', $status)->first();
//        $sum = 0;
//
//        if($status->title === 'cart') {
//            $orders = Order::where('order_status_id', $status->id)->get();
//            foreach ($orders as $order) {
//                $sum += $order->orderable->price;
//            }
//        }
//
//        return $sum;
//    }
}
