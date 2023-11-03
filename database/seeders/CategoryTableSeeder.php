<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Economy Hostel',
            ],
            [
                'name' => 'Standard Hostel',
            ],
            [
                'name' => 'Luxury Hostel',
            ],
            [
                'name' => 'Co-Living Space',
            ],
            [
                'name' => 'Specialty Hostel',
            ],
            [
                'name' => 'Family-Style Hostel',
            ],
            [
                'name' => 'Green Hostel',
            ],
            [
                'name' => 'Historic Hostel',
            ],
            [
                'name' => 'Adventure Hostel',
            ],

        ];

        Category::insert($categories);
    }
}
