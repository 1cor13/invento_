<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;
use App\ItemOrderPivot;
use App\Customer;

class Order extends Model
{
    // protected $table = 'users';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->using(ItemOrderPivot::class)
            ->withPivot(['quantity', 'price'])
            ->withTimestamps();
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
