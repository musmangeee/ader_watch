<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Business;
use Faker\Generator as Faker;

$factory->define(Business::class, function (Faker $faker) {

    $name = $faker->name;
    $town = \App\Town::all()->random(1)->first();
    $city = \App\City::where('id', $town['city_id'])->first();

    return [
        'user_id' => rand( 1, 50),
        'name' => $faker->name,
        'slug' =>  strtolower(str_replace(' ', '-', preg_replace("/[^ \w]+/", "", $name)) . '-' .$city['name']) ,
        'url' => $faker->url,
        'phone' => $faker->phoneNumber,
        'town_id' => $town['id'],
        'address' => $faker->address,
        'business_email' => $faker->unique()->safeEmail,
        'latitude' => '',
        'longitude' => '',
        'type' => '',
        'message' => $faker->text(50),
        'description' => $faker->text(2000),
    ];
});
