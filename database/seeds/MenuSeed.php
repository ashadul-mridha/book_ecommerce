<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'item_one' => 'হোম',
            'item_two' => 'বই',
            'item_three' => 'লেখক',
            'item_four' => 'প্রকাশনী',
            'item_five' => 'বেস্টসেলার বই',
            'item_six' => 'বইমেলা ২০২০',
        ]);
    }
}
