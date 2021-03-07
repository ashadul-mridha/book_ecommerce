<?php

use App\Models\Header;
use Illuminate\Database\Seeder;

class HeaderSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Header::create([
            'contact_number' => '+8801111111111',
        ]);
    }
}
