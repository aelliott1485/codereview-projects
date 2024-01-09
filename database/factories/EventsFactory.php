<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Events>
 */
class EventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'start' => $this->faker->dateTime,
            'end' => $this->faker->dateTime,
            'category' => $this->faker->mimeType(),
            'level' => $this->faker->randomNumber(),
            'boookable' => $this->faker->boolean,
            'repeats' =>  $this->faker->randomNumber(),
            'duration' =>  $this->faker->randomNumber(),
        ];
    }
}
