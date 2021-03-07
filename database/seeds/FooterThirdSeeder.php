<?php

use App\Models\FooterThird;
use Illuminate\Database\Seeder;

class FooterThirdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FooterThird::create([
            'title' => 'Service',
            'name' => 'Managed IT|IT Support|Cecurity|FAQ’s|Capital',
            'link' => '#|#|#|#|#',
        ]);
    }
}
