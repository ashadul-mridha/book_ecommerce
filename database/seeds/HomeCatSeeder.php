<?php

use Illuminate\Database\Seeder;

class HomeCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\HomePageCategory::class, 4)->create();
    }
}
