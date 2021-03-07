<?php

use App\Models\Search;
use Illuminate\Database\Seeder;

class SearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Search::create([
            'categorie_icon' => 'fas fa-bars',
            'categorie_name' => 'All Categories',
            'search_placeholder' => 'Find your books',
            'search_icon' => 'fas fa-search',
            'offer_name' => 'dfsdfsdf',
            'offer_second_name' => 'dfsdfsd',
        ]);
    }
}
