<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = ['name', 'make', 'code', 'price','quantity', 'description', 'size'];
    //
    public function orderLines() {
        return $this->hasMany(orderLine::class);
    }
}
