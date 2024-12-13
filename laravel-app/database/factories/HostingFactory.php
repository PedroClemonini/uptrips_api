<?php

namespace Database\Factories;

use App\Models\Hosting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hosting>
 */
class HostingFactory extends Factory
{

    protected $model = Hosting::class;


    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->text,
            'document' => $this->faker->randomNumber,
            'address' => $this->faker->address,
            'contact_phone' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->safeEmail,
            'destination_id' => \App\Models\Destination::factory()

        ];
    }
}
