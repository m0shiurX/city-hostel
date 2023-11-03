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
                'name' => 'Old Dhaka',
            ],
            [
                'name' => 'Gulshan',
            ],
            [
                'name' => 'Mirpur',
            ],
            [
                'name' => 'Dhanmondi',
            ],
            [
                'name' => 'Uttara',
            ],
            [
                'name' => 'Banani',
            ],

        ];

        Area::insert($areas);
    }
}
