<?php

use App\Models\BoimelaCategory;
use Illuminate\Database\Seeder;

class BoimelaCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BoimelaCategory::create([
            'category_id' => App\Models\Category::all()->random()->id,
            'status' => 1
        ]);
    }
}
