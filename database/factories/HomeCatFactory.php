<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\HomePageCategory;
use Faker\Generator as Faker;

$factory->define(HomePageCategory::class, function (Faker $faker) {
    return [
        'category_id' => App\Models\Category::all()->random()->id,
        'status' => 1,
    ];
});
