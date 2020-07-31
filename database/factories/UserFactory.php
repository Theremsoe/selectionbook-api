<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\User;
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

$factory->define(User::class, fn (Faker $faker): array => [
    'name' => $faker->name,
    'last_name' => $faker->lastName,
    'email' => $faker->unique()->safeEmail,
    'username' => $faker->unique()->userName,
    'password' => $faker->password,
    'born_date' => $faker->date(),
]);
