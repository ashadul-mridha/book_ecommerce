<?php

use Illuminate\Database\Seeder;

class BookPublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book_publisher = factory(App\Models\Publisher::class, 10)->create();
    }
}
