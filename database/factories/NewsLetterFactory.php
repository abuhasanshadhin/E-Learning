<?php

use Faker\Generator as Faker;
use App\NewsLetter;

$factory->define(NewsLetter::class, function (Faker $faker) {
    return [
        'email' => $faker->safeEmail
    ];
});
