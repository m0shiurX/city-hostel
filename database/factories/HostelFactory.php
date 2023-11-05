<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hostel>
 */
class HostelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => fake()->streetName(),
            'phone' => fake()->e164PhoneNumber(),
            'address' => fake()->streetAddress(),
            'built_on' => fake()->year(),
            'total_seat' => fake()->randomNumber(2, true),
            'garage' => fake()->randomElement(['yes', 'no']),
            'garage_size' => fake()->randomNumber(4, true),
            'area_id' => fake()->numberBetween(1, 6),
            'created_by_id' => function () {
                $role = 2;
                return User::whereHas('roles', function ($query) use ($role) {
                    $query->where('id', $role);
                })->inRandomOrder()->first()->id;
            }
        ];
    }
}
