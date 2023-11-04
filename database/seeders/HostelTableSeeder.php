<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Hostel;
use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HostelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hostels = [
            [
                'name' => 'Testing Hostel 1',
                'phone' => '999999',
                'address' => 'Banani, Sector 3, road #23, House #45',
                'built_on' => '2019',
                'total_seat' => '34',
                'garage' => 'yes',
                'garage_size' => '2000sqft',
                'area_id' => 1
            ],
            [
                'name' => 'Testing Hostel 2',
                'phone' => '999999',
                'address' => 'Uttara Sector 3, road #21, House #76',
                'built_on' => '2019',
                'total_seat' => '34',
                'garage' => 'yes',
                'garage_size' => '2000sqft',
                'area_id' => 6
            ],
            [
                'name' => 'Testing Hostel 3',
                'phone' => '999999',
                'address' => 'Dhanmondi, Sector 3, road #20, House #4',
                'built_on' => '2019',
                'total_seat' => '34',
                'garage' => 'yes',
                'garage_size' => '2000sqft',
                'area_id' => 2
            ],
            [
                'name' => 'Testing Hostel 4',
                'phone' => '999999',
                'address' => 'Banani, Sector 3, road #29, House #43',
                'built_on' => '2019',
                'total_seat' => '34',
                'garage' => 'yes',
                'garage_size' => '2000sqft',
                'area_id' => 3
            ],
            [
                'name' => 'Testing Hostel 5',
                'phone' => '999999',
                'address' => 'Uttara Sector 3, road #28, House #23',
                'built_on' => '2019',
                'total_seat' => '34',
                'garage' => 'yes',
                'garage_size' => '2000sqft',
                'area_id' => 5
            ],
            [
                'name' => 'Testing Hostel 6',
                'phone' => '999999',
                'address' => 'Dhanmondi, Sector 3, road #27, House #45',
                'built_on' => '2019',
                'total_seat' => '34',
                'garage' => 'yes',
                'garage_size' => '2000sqft',
                'area_id' => 4
            ],

        ];

        Hostel::insert($hostels);


        $hostels = Hostel::all();

        $hostels->each(function ($hostel) {
            $randomCategoryIds = Category::inRandomOrder()->limit(1)->pluck('id');
            $hostel->categories()->attach($randomCategoryIds);
        });

        $hostels->each(function ($hostel) {
            $randomFacilityIds = Facility::inRandomOrder()->limit(3)->pluck('id'); // Retrieve 3 random Facility IDs
            $hostel->facilities()->attach($randomFacilityIds); // Attach the random Facility IDs to the current Hostel
        });
    }
}
