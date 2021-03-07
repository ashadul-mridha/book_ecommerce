<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [
            'manage-admin-area',
            'manage-order',
            'manage-boimela',
            'manage-roles',
            'manage-users',
            'manage-books',
            'manage-categories',
            'manage-subcategories',
            'manage-authors',
            'manage-publishers',
            'manage-coupons',
            'manage-home-page',
            'manage-all-page',
            'manage-boimela-categories',
            'manage-headers',
            'manage-banners',
            'manage-company-slider',
            'manage-footers',
            'manage-ads',
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
