<?php

// /** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item; 
use App\Order;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Order::class, function(Faker $faker) {
    return [
        'order_number' => rand(),
        'user_id' => 1,
        'customer_id' => 1
    ];  

});

$factory->afterCreating(Order::class, function ($order, $faker) {

    $items = factory(Item::class, 2)->create();

    $itemsWithPivot = $items->mapWithKeys(function($item) use ($faker) {
        return [
            $item->id => [
                'quantity' => 1,
                'price' => $item->price
            ]
        ];
    })->all();

    $order->items()->sync($itemsWithPivot);


    $order->subtotal = $order->items->reduce(function($carry, $orderItem) {
        return $carry + ($orderItem->pivot->price * $orderItem->pivot->quantity);
    }, 0);

    $order->save();
});