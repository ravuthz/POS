<?php

use Faker\Generator as Faker;

$factory->define(App\Models\OrderProduct::class, function (Faker $faker) {
    return [
        'order_id' => random_int(1, 10),
        'product_id' => random_int(1, 10),
        'quantity' => random_int(1, 100)
    ];
});