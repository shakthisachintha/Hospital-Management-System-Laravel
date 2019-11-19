<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attendance;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(App\User::pluck('id', 'id')->toArray()),
        'start' => $faker->date('2019-m-d'),
        'end' => Carbon::now()
    ];
});
