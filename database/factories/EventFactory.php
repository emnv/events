<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_code' => $this->faker->unique()->bothify('EVT-####'),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'venue' => $this->faker->address(),
            'start_datetime' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'end_datetime' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'total_capacity' => $this->faker->numberBetween(50, 500),
            'status' => $this->faker->randomElement(['upcoming', 'ongoing', 'completed', 'cancelled']),
        ];
    }
}
