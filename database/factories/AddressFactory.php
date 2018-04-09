<?php

use App\Models\Users\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'receiver' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'location' => $faker->address,
    ];
});
