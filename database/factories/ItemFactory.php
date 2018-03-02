<?php

use App\Models\Shops\Items\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'store_id' => null,
        'name' => $faker->sentence,
        'slug' => $faker->slug,
        'price' => $faker->randomNumber(6),
        'stock' => $faker->numberBetween(10, 20),
    ];
});
