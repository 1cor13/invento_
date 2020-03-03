<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    const SALEABLE = 1;

    protected $fillable = ['name', 'brand', 'code', 'price','quantity', 'description', 'size', 'saleable', 'minimum_quantity'];
    protected $attributes = ['saleable' => self::SALEABLE ];
    
    // public function orderLines() {
    //     return $this->hasMany(orderLine::class);
    // }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot(['quantity', 'price'])
            ->withTimestamps();
    }

}
