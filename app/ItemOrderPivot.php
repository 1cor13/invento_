<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemOrderPivot extends Pivot
{
    protected $table = 'item_order';

    public $incrementing = true;

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
