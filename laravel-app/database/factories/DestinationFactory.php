<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    protected $model = Destination::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
        ];
    }
}

