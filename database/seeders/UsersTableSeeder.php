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
                'verified'           => 1,
                'verified_at'        => '2023-10-18 19:30:46',
                'verification_token' => '',
                'phone'              => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'Hostel Owner',
                'email'              => 'owner@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2023-10-18 19:30:46',
                'verification_token' => '',
                'phone'              => '',
            ],
            [
                'id'                 => 3,
                'name'               => 'Student',
                'email'              => 'student@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2023-10-18 19:30:46',
                'verification_token' => '',
                'phone'              => '',
            ],
        ];

        User::insert($users);
    }
}
