<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Account::class, function (Faker $faker) {
    return [
        'description' => $faker->text(rand(10, 100))
    ];
});
