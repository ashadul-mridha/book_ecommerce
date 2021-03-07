<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(SubCategory::class, function (Faker $faker) {


    do {
        $foundName = false;

        $title = $faker->firstName();

        if (SubCategory::where('title', '=', $title)->first() != null) {
            $foundName = true;
        }
    } while( $foundName == true );

    $slug = Str::slug($title, '-');
    return [
        'title' => $title,
        'slug' => $slug,
        'category_id' => App\Models\Category::all()->random()->id,
    ];
});
