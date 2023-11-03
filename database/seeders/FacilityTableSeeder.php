<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            ['name' => 'Art-themed decor', 'details' => ''],
            ['name' => 'Basic furnishings',  'details' => ''],
            ['name' => 'Co-working spaces',  'details' => ''],
            ['name' => 'Common areas',  'details' => ''],
            ['name' => 'Common kitchen',  'details' => ''],
            ['name' => 'Communal gatherings',  'details' => ''],
            ['name' => 'Energy-efficient design',  'details' => ''],
            ['name' => 'Equipment rental',  'details' => ''],
            ['name' => 'Events and activities',  'details' => ''],
            ['name' => 'Family-style meals',  'details' => ''],
            ['name' => 'Fitness center',  'details' => ''],
            ['name' => 'Grooming services',  'details' => ''],
            ['name' => 'Guided adventure tours',  'details' => ''],
            ['name' => 'Historical tours',  'details' => ''],
            ['name' => 'Hiking and sports facilities',  'details' => ''],
            ['name' => 'Laundry',  'details' => ''],
            ['name' => 'Pet-friendly rooms',  'details' => ''],
            ['name' => 'Pet play areas',  'details' => ''],
            ['name' => 'Private and shared apartments',  'details' => ''],
            ['name' => 'Private and shared rooms',  'details' => ''],
            ['name' => 'Private rooms with en-suite bathrooms',  'details' => ''],
            ['name' => 'Recycling programs',  'details' => ''],
            ['name' => 'Restaurant',  'details' => ''],
            ['name' => 'Shared rooms ',  'details' => ''],
            ['name' => 'Specialty rooms (e.g., art-themed, sports-themed)',  'details' => ''],
            ['name' => 'Study spaces',  'details' => ''],
            ['name' => 'Themed decor',  'details' => ''],
            ['name' => 'Unique architecture',  'details' => ''],
            ['name' => 'Wi-Fi',  'details' => ''],
        ];
        Facility::insert($facilities);
    }
}
