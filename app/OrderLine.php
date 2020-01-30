<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $fillable = ['quantity', 'price', 'order_id', 'inventory_id'];

    public function inventoryItem() {
        return $this->hasOne(InventoryItem::class);
    }
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
