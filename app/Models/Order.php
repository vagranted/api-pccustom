<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\ExecutionStatus;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $with = [];

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }

    public function components()
    {
        return $this->morphedByMany(Component::class, 'orderable');
    }

    public function computers()
    {
        return $this->morphedByMany(Computer::class, 'orderable');
    }

    public function getSumAttribute()
    {
        $sum = 0;

        if($this->computers->isNotEmpty()) {
            foreach ($this->computers as $computer) {
                $sum += $computer->price;
            }
        } else if($this->components->isNotEmpty()) {
            $sum += $this->components()->sum('price');
        }

        return $sum;
    }
}
