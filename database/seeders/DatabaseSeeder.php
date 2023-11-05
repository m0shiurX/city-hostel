<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            AreaTableSeeder::class,
            TagTableSeeder::class,
            FacilityTableSeeder::class,
            CategoryTableSeeder::class,
            HostelTableSeeder::class,
        ]);
    }
}
