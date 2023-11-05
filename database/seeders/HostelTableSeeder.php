<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Hostel;
use App\Models\Room;
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
        $categoryIds = Category::inRandomOrder()->get()->pluck('id');
        $facilityIds = Facility::inRandomOrder()->get()->pluck('id');

        Hostel::factory()
            ->has(Room::factory()->count(25), 'hostelRooms')
            ->count(25)->create()
            ->each(function (Hostel $hostel) use ($categoryIds, $facilityIds) {
                $hostel->categories()->attach(fake()->randomElements($categoryIds));
                $hostel->facilities()->attach(fake()->randomElements($facilityIds, 5));
            });
    }
}
