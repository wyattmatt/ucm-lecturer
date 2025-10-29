<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecturer>
 */
class LecturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = [
            'Management',
            'Visual Communication Design',
            'Informatics',
            'Magister Management'
        ];

        $titles = [
            'Dr.',
            'Prof.',
            'S.Kom., M.Kom.',
            'S.T., M.T.',
            'S.E., M.M.',
            'S.Ds., M.Ds.',
            'S.Kom., M.T.',
            'Ir., M.Sc.',
        ];

        $selectedDepartments = fake()->randomElements($departments, fake()->numberBetween(1, 3));

        return [
            'name' => fake()->name(),
            'title' => fake()->randomElement($titles),
            'room' => fake()->numberBetween(101, 599),
            'departments' => $selectedDepartments,
            'image' => 'lecturer' . fake()->numberBetween(1, 20),
            'image_type' => fake()->randomElement(['jpg', 'png']),
            'image_size' => fake()->numberBetween(50, 500) . 'KB',
        ];
    }
}
