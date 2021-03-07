<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'isbn' => $faker->isbn10(),
        'user_id' => App\User::all()->random()->id,
        'author_id' => App\Models\Author::all()->random()->id,
        'publisher_id' => App\Models\Publisher::all()->random()->id,
        'title' => $faker->sentence(3),
        'price' => $faker->randomFloat(2, 0, 200),
        'description' => $faker->paragraph(),
        'quantity' => rand(1,6),
        'edition' => '1st',
        'language' => 'English',

    ];
});
