<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();
        $fakeUrl = fake()->imageUrl();
        $rooms->each(function ($room) use ($fakeUrl) {
            $room->addMediaFromUrl($fakeUrl)->toMediaCollection('images');
        });
    }
}
