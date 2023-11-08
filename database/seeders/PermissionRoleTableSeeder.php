<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        $host_permissions = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 32, 33, 35, 42, 43, 45, 58];
        $student_permissions = [31, 33, 35, 41, 42, 43, 45, 58];

        Role::findOrFail(2)->permissions()->sync($host_permissions);
        Role::findOrFail(3)->permissions()->sync($student_permissions);
    }
}
