<?php

use App\Models\FooterSecond;
use Illuminate\Database\Seeder;

class FooterSecondSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FooterSecond::create([
            'title' => 'Quick link',
            'name' => 'Home|About|Service|Feedback',
            'link' => '#|#|#|#',
        ]);
    }
}
