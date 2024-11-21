<?php

namespace Database\Factories;

use App\Models\Trips;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Packages>
 */
class PackagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'packageName' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->optional()->paragraph(),
            'price' => $this->faker->randomFloat(2, 100, 10000),
            'startDate' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'endDate' => $this->faker->dateTimeBetween('+1 month', '+3 months')->format('Y-m-d'),
            'maxPeople' => $this->faker->numberBetween(1, 50),
            'isActive' => $this->faker->boolean(),
            'tripId' => Trips::factory(),
        ];
    }
}
