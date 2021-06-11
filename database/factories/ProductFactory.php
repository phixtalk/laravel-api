<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->text(30),
        'description' => $faker->text,
        'image' => $faker->imageUrl(),
        'price' => $faker->numberBetween(10, 100),
    ];
});
