<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'order_statuses';
    protected $primaryKey = 'id';

    public function orders()
    {
        return $this->hasMany(Order::class, 'order_status_id', 'id');
    }
}
