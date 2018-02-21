<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SettingItem::class, function (Faker $faker) {
    return [
        'setting_type_model' => $faker->name(),
        'name'               => $faker->name(),
        'name_kh'            => $faker->name(),
        'note'               => $faker->sentence(),
        'value'              => $faker->sentence(),
        'setting_type_id'    => random_int(1, 10)
    ];
});
