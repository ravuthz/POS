<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Models\Order::class, function (Faker $faker) {
    return [
        'ordered_by' => Auth::user()->id,
        'ordered_at' => Carbon::now()
    ];
});
