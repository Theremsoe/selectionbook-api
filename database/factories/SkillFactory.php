<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Skill;
use App\Model\User;
use Faker\Generator as Faker;

$factory->define(Skill::class, fn (Faker $faker): array => [
    'name' => $faker->sentence(),
    'details' => $faker->text(),
]);

$factory->state(Skill::class, 'with-user', fn (): array => ['user_id' => factory(User::class)->create()->getKey()]);
