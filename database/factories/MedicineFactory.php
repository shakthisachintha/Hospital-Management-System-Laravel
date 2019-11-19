<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Medicine;
use Illuminate\Support\Str;
use Faker\Generator as Faker;



$factory->define(Medicine::class, function (Faker $faker) {
    return [
        'name_sinhala' => $faker->name,
        'name_english' => $faker->unique()->safeEmail,
        'qty' => $faker->numerify(),
    ];
});
