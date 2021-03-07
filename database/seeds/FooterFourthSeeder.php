<?php

use App\Models\FooterFourth;
use Illuminate\Database\Seeder;

class FooterFourthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FooterFourth::create([
            'title' => 'Company',
            'name' => 'About Us|Cookies Policy|Client’s|Privacy|Pricing',
            'link' => '#|#|#|#|#',
        ]);
    }
}
