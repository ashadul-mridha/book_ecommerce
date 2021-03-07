<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'book_id' => App\Models\Book::all()->random()->id,
        'user_id' => App\User::all()->random()->id,
        'rating' => $faker->numberBetween(0, 5),
        'comment' => $faker->paragraph,
    ];
});
