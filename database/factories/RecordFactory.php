<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Record::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 1, 20),
        'date' => \Carbon\Carbon::now(),
        'description' => $faker->text(20)
    ];
});
