<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use App\Programme;
use App\Timetable;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Timetable::class, function (Faker $faker) {
    $channels = Channel::all()->pluck('id')->toArray();
    $programmes = Programme::all()->pluck('id')->toArray();
    $timezone = $faker->randomElement(timezone_identifiers_list());

    return [
        'id' => $faker->uuid,
        'channel_id' => $faker->randomElement($channels),
        'programme_id' => $faker->randomElement($programmes),
        'start_time' => $faker->dateTimeBetween('-1 hour', 'now', $timezone),
        'end_time' => $faker->dateTimeBetween('+1 hour', '+2 hours', $timezone),
        'timezone' => $timezone,
    ];
});
