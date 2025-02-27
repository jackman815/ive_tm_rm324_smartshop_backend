<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductManagement\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'          => $faker->word,
        'description'   => $faker->text($maxNbChars = 20),
    ];
});
