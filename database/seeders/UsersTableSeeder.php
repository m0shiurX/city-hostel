<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'phone'              => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'Hostel Owner',
                'email'              => 'host@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'phone'              => '',
            ],
            [
                'id'                 => 3,
                'name'               => 'Student',
                'email'              => 'student@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'phone'              => '',
            ],
        ];

        User::insert($users);
    }
}
