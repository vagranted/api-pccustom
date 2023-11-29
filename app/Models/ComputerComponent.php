<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ComputerComponent extends Pivot
{
    public $timestamps = false;
    protected $table = 'computer_component';
    protected $primaryKey = 'id';
}
