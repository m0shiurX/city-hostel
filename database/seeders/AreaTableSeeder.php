<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'id'   => 1,
                'name' => 'Old Dhaka',
            ],
            [
                'id'   => 2,
                'name' => 'Gulshan',
            ],
            [
                'id'   => 3,
                'name' => 'Mirpur',
            ],
            [
                'id'   => 4,
                'name' => 'Dhanmondi',
            ],
            [
                'id'   => 5,
                'name' => 'Uttara',
            ],
            [
                'id'   => 6,
                'name' => 'Banani',
            ],

        ];

        Area::insert($areas);
    }
}
