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

    // create new items and them or retrieve two items from the DB and use them
    $items = Item::all()->take(2) ?? factory(Item::class, 2)->create(); // will be a retrieval from database
    // $itemsDB = Item::all()->take(2); // 

    $itemsWithPivot = $items->mapWithKeys(function($item) {
        return [
            $item->id => [
                'quantity' => rand(1, $item->quantity),
                'price' => $item->price
            ]
        ];
    })->all();

    $order->items()->attach($itemsWithPivot);

    $order->subtotal = $order->items->reduce(function($carry, $orderItem) {
        return $carry + ($orderItem->pivot->price * $orderItem->pivot->quantity);
    }, 0);
    $fees = 0;
    $taxes = 0 * $order->subtotal;
    $discount = 0;
    $order->totalcost = $order->subtotal + $taxes + $fees - $discount;

    $order->save();
    

    // Update item inventory quantities
    foreach ($items as $item) {
        dump($item->quantity);
        $item->quantity -= ((object)$itemsWithPivot[$item->id])->quantity; //$itemsWithPivot[$item->id]['quantity']
        $item->depleted = $item->quantity <= $item->minimum_quantity;
        $item->save(); // use mass save so you hit the db once for all items.
    }
    
});