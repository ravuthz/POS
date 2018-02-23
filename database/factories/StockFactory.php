<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Stock::class, function (Faker $faker) {
    return [
        'movement' => random_int(0, 1)
    ];
});
