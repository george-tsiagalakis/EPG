<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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

$factory->define(Programme::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'name' => $faker->unique()->company,
        'description' => $faker->unique()->realText(500, 2),
        'thumbnail' => $faker->unique()->imageUrl(200, 200, 'business', true, 'Faker'),
    ];
});
