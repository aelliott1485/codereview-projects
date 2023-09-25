<?php

namespace Database\Factories;

use App\Models\Org;
use App\Models\SubOrg;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Org>
 */
class SubOrgFactory extends Factory
{
    protected $model = SubOrg::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'merged' => false
        ];
    }
}
