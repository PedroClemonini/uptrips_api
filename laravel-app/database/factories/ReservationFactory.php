<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accommodation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'childs' => $this->faker->numberBetween(0, 5),
            'adults' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 50, 1000),
            'status' => $this->faker->randomElement(['awaiting_payment', 'payed', 'canceled']),
            'payment_date' => $this->faker->optional()->date(),
            'trip_package_id' => \App\Models\TripPackage::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
