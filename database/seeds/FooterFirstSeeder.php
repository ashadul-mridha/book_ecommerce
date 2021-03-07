<?php

use App\Models\FooterFirst;
use Illuminate\Database\Seeder;

class FooterFirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FooterFirst::create([
            'logo' => 'logo.png',
            'description' => 'Smashing spiffing good time gutted mate geeza.',
            'social_icon' => 'fab fa-facebook-f|fab fa-twitter|fab fa-vimeo-v|fab fa-youtube',
            'social_link' => '#|#|#|#',
        ]);
    }
}
