<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'components';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(ComponentType::class, 'component_type_id', 'id');
    }

    public function computers()
    {
        return $this->belongsToMany(
            Computer::class,
            'computer_component',
            'component_id',
            'computer_id'
        );
    }

    public function selected()
    {
        return $this->morphMany(SelectedProduct::class, 'selectable');
    }
}
