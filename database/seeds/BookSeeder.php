<?php

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = factory(App\Models\Book::class, 70)->create()->each(
            function ($book) {
                $subcategories = App\Models\SubCategory::all()->random(mt_rand(1,4))->pluck('id');
                $book->subcategories()->attach($subcategories);
            }
        );
    }
}
