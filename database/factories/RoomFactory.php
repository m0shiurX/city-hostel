<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hostel_id' => fake()->numberBetween(1, 6),
            'room_info' => fake()->name(),
            'price' =>  fake()->randomNumber(4, true),
            'capacity' => fake()->randomNumber(2, true),
            'placement' => fake()->randomElement(['Window', 'Door', 'Side Wall']),
            'status' => fake()->randomElement(['available', 'booked', 'off']),
            'created_by_id' => function () {
                return User::inRandomOrder()->first()->id;
            }
        ];
    }
}
