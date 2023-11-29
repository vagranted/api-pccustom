<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'component_types';
}
