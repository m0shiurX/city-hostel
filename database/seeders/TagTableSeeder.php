<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tag::factory()->count(20)->create();

        $tags = [
            ['name' => 'Luxury'],
            ['name' => 'Budget'],
            ['name' => 'Co-Living'],
            ['name' => 'Student'],
            ['name' => 'Backpacker'],
            ['name' => 'Boutique'],
            ['name' => 'Single Room'],
            ['name' => 'Double Room'],
            ['name' => 'Shared Room'],
            ['name' => 'Apartment'],
            ['name' => 'Dormitory'],
            ['name' => 'Wi-Fi'],
            ['name' => 'Gym'],
            ['name' => 'Pool'],
            ['name' => 'Kitchen'],
            ['name' => 'Laundry'],
            ['name' => 'Parking'],
            ['name' => 'Study Areas'],
            ['name' => '24/7 Security'],
            ['name' => 'Restaurant'],
            ['name' => 'Common Areas'],
            ['name' => 'Air Conditioning'],
            ['name' => 'Heating'],
            ['name' => 'Bed Linens'],
            ['name' => 'Towels'],
            ['name' => 'Toiletries'],
            ['name' => 'TV'],
            ['name' => 'Fridge'],
            ['name' => 'Microwave'],
            ['name' => 'Coffee Maker'],
            ['name' => 'Hairdryer'],
            ['name' => 'Downtown'],
            ['name' => 'Near Campus'],
            ['name' => 'Near Public Transport'],
            ['name' => 'Residential Area'],
            ['name' => 'City Center'],
            ['name' => 'Pet-Friendly'],
            ['name' => 'Eco-Friendly'],
            ['name' => 'Historical Building'],
            ['name' => 'Scenic Views'],
            ['name' => 'Themed Decor'],
            ['name' => 'Outdoor Space'],
            ['name' => 'En-Suite Bathroom'],
            ['name' => 'Balcony'],
            ['name' => 'Private Kitchen'],
            ['name' => 'Work Desk'],
            ['name' => 'Wardrobe'],
            ['name' => 'Lockers'],
            ['name' => 'Workshops'],
            ['name' => 'Movie Nights'],
            ['name' => 'Social Events'],
            ['name' => 'Fitness Classes'],
            ['name' => 'Cultural Activities'],
            ['name' => 'Game Nights'],
            ['name' => 'Cleaning Service'],
            ['name' => 'Room Service'],
            ['name' => 'Shuttle Service'],
            ['name' => '24/7 Reception'],
            ['name' => 'Security Service'],
            ['name' => 'Concierge Service'],
            ['name' => 'Wheelchair Accessible'],
            ['name' => 'Elevator'],
            ['name' => 'Braille Signage'],
            ['name' => 'Accessible Parking'],
            ['name' => 'Artsy'],
            ['name' => 'Sports-Centric'],
            ['name' => 'Adventure'],
            ['name' => 'Relaxation'],
            ['name' => 'Vintage'],
            ['name' => 'Breakfast Included',],
            ['name' => 'Half Board'],
            ['name' => 'Full Board'],
            ['name' => 'Self-Catering'],
        ];

        Tag::insert($tags);
    }
}
