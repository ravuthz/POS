<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'image' => $faker->imageUrl(),
        'parent_id' =>  random_int(1, 5)
    ];
});
