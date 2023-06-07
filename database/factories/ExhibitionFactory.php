<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exhibition>
 */
class ExhibitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(4, 6),
            'start_time' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'end_time' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
        ];
    }
}
