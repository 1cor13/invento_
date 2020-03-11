<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemOrderPivot extends Pivot
{
    protected $table = 'item_order';

    public $incrementing = true;
}
