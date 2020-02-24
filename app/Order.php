<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

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
            ->withPivot(['quantity', 'price'])
            ->withTimestamps();
    }
}
