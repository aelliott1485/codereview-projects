<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tickets>
 */
class TicketsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text,
            'price' => $this->faker->randomNumber(),
            'min' => $this->faker->randomNumber(),
            'max' => $this->faker->randomNumber(),
            'students' => $this->faker->randomNumber(),
            'event_id' => $this->faker->randomNumber()
        ];
    }
}
