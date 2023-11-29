<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'computers';
    protected $primaryKey = 'id';

    public function components()
    {
        return $this->belongsToMany(
            Component::class,
            'computer_component',
            'computer_id',
            'component_id'
        );
    }

    public function orders()
    {
        return $this->morphMany(Order::class, 'orderable');
    }
}
