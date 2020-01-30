<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description'];

    public function serviceItems() {
        return $this->hasMany(ServiceItem::class);
    }
}
