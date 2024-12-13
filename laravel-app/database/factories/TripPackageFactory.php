<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripPackage>
 */
class TripPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->paragraph(),
            'image1_path' => $this->faker->imageUrl(),
            'image2_path' => $this->faker->optional()->imageUrl(),
            'image3_path' => $this->faker->optional()->imageUrl(),
            'image4_path' => $this->faker->optional()->imageUrl(),
            'image5_path' => $this->faker->optional()->imageUrl(),
            'image6_path' => $this->faker->optional()->imageUrl(),
            'image7_path' => $this->faker->optional()->imageUrl(),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeBetween('+1 year', '+2 years')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'child_value' => $this->faker->randomFloat(2, 10, 100),
            'adult_value' => $this->faker->randomFloat(2, 20, 200),
            'destination_id' => \App\Models\Destination::factory(),
            'hosting_id' => \App\Models\Hosting::factory()
        ];
    }
}
