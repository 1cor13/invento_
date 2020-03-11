<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Order;
use App\ItemOrderPivot;

class Item extends Model
{
    use SoftDeletes;
    const SALEABLE = 1;

    protected $fillable = ['name', 'brand', 'code', 'price','quantity', 'description', 'size', 'saleable', 'minimum_quantity'];
    protected $attributes = ['saleable' => self::SALEABLE ];


    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->using(ItemOrderPivot::class)
            ->withPivot(['quantity', 'price'])
            ->withTimestamps();
    }

}
