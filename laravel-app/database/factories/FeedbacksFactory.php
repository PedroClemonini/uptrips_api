<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Feedbacks;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedbacks>
 */
class FeedbacksFactory extends Factory
{
    protected $model = Feedbacks::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'feedbackNotes' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
            'description' => $this->faker->paragraph,
            'date' => $this->faker->date,
            'user_id' => User::factory()
        ];
    }
}
