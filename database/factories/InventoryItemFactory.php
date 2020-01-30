<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InventoryItem;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(InventoryItem::class, function (Faker $faker) {
    $brand = $faker->randomElement(['Avon','Bridgestone','Continental','Dunlop','Firestone','Goodyear','Hankook','Michelin','Pirelli','Uniroyal','Yokohama']);
    $size = random_int(9,30);
    $code = strtoupper(Str::random(2)).random_int(1234,9999);

    return [
        'code' => "{$code}",
        'size' => "{$size}'",
        'brand' => "{$brand}",
        'name' => "{$size}' {$code} {$brand}",
        'price' => rand(10,300),
        'description' => $faker->sentence,
        'quantity' => rand(50,100),
        'minimum_quantity' => rand(5,10),
        'saleable' => $faker->boolean
    ];
});
