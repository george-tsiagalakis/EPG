<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Timetable;
use App\Channel;
use App\Programme;
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

    $channels   = Channel::all()->pluck('id')->toArray();
    $programmes = Programme::all()->pluck('id')->toArray();

    return [
        'uuid'         => $faker->uuid,
        'start_time'   => $faker->dateTimeBetween($startDate = '-1 week', $endDate = 'now', $timezone = 'UTC'),
        'end_time'     => $faker->dateTimeBetween($startDate = '-1 week', $endDate = 'now', $timezone = 'UTC'),
        'channel_id'   => $faker->randomElement($channels),
        'programme_id' => $faker->randomElement($programmes),
    ];
});
