<?php

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

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'type' => 'image',
        'level_min' => $faker->numberBetween(1,5),
        'reward_points' => $faker->numberBetween(1,50),
        'background_image_path' => '/images/loremipsum-background2.jpg'
    ];
});
