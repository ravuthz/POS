<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SettingType::class, function (Faker $faker) {
    return [
        'name'    => $faker->name(),
        'name_kh' => $faker->name(),
        'note'    => $faker->sentence()
    ];
});
