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
        $startDate = fake()->dateTimeBetween('now', '+1 month');
        $endDate = fake()->dateTimeBetween($startDate, '+2 months');

        return [
            'title' => fake()->sentence(4),
            'image' => 'event' . fake()->numberBetween(1, 10) . '.' . fake()->randomElement(['jpg', 'png']),
            'description' => fake()->paragraph(5),
            'start_date' => $startDate->format('Y-m-d'),
            'start_time' => fake()->time('H:i:s'),
            'end_date' => $endDate->format('Y-m-d'),
            'end_time' => fake()->time('H:i:s'),
            'modified_by' => null,
        ];
    }
}
