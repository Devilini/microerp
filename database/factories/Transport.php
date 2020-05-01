<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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

$factory->define(\App\Transport::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'color' => $faker->colorName,
        'year' => $faker->year,
        'status' => 'активная',
        'type_id' => rand(1, 3)
    ];
});
