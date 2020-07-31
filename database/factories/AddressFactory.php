<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Address;
use App\Model\User;
use Faker\Generator as Faker;

$factory->define(Address::class, fn (Faker $faker): array => [
    'street' => $faker->secondaryAddress,
    'city' => $faker->city,
    'state' => $faker->state,
    'zipcode' => $faker->postcode,
    'country' => $faker->country,
    'geometry' => [
        'type' => 'Point',
        'coordinates' => [$faker->longitude, $faker->latitude],
    ],
]);

$factory->state(Address::class, 'with-user', static function (): array {
    return [
        'addressable_type' => User::class,
        'addressable_id' => factory(User::class)->create()->getKey(),
    ];
});
