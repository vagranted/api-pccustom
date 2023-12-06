<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderablePivot extends Model
{
    use HasFactory;

    protected $table = 'orderables';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function orderable()
    {
        return $this->morphTo();
    }
}
