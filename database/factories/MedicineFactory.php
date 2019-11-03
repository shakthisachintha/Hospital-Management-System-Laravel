<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Medicine;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Medicine::class, function (Faker $faker) {
    return [
        'name_sinhala' => $faker->name,
        'name_english' => $faker->unique()->safeEmail,
        'qty' => $faker->numerify(),
    ];
});
