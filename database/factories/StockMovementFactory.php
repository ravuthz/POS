<?php

use Faker\Generator as Faker;

$factory->define(App\Models\StockMovement::class, function (Faker $faker) {
    return [
        'stock_id' => random_int(1, 10),
        'product_id' => random_int(1, 10),
        'price' => random_int(100, 200),
        'quantity' => random_int(1, 100)
    ];
});