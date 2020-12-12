<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,50),
        'business_id' => \App\Business::all()->random(1)->first()['id'],
        'stars' => rand(1,5),
        'text' => $faker->text,
        'cool' => $faker->boolean,
        'funny' => $faker->boolean,
        'useful' => $faker->boolean,
    ];
});
