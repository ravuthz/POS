<?php

use Faker\Generator as Faker;

$factory->define(App\Models\OrderProduct::class, function (Faker $faker) {
    return [
        'order_id' => random_int(1, 10),
        'product_id' => random_int(1, 10),
        'price' => random_int(100, 200),
        'quantity' => random_int(1, 100)
    ];
});