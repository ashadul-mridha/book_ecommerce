<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeed::class,
            RoleSeed::class,
            UserSeed::class,
            HeaderSeed::class,
            SearchSeeder::class,
            MenuSeed::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            HomeCatSeeder::class,
            BoimelaCatSeeder::class,
            BookAuthorSeeder::class,
            BookPublisherSeeder::class,
            BookSeeder::class,
            ReviewSeeder::class,
            FooterFirstSeeder::class,
            FooterSecondSeeder::class,
            FooterThirdSeeder::class,
            FooterFourthSeeder::class,
        ]);
    }
}
