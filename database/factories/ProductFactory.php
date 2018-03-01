<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $price = random_int(100, 500);
    return [
        'name' => $faker->name(),
        'name' => $faker->name(),
        'name_kh' => $faker->name(),
        'note' => $faker->sentence(),
        'image' => $faker->imageUrl(),
        'buy_price' => $price,
        'sale_price' => ($price + 100)
    ];
});

