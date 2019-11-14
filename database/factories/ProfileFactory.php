<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\User')->create()->id,
        'location' => $faker->randomElement(['indoor','outdoor']),
        'bow' => $faker->randomElement(['recurve','compound','barebow','longbow']),
        'handicap' => '0',
        'classification' => '0',

    ];
});
