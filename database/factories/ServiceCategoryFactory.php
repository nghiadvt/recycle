<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'parent_id' => null,
            'slug' => $this->faker->slug,
            'description' => $this->faker->sentence,
            'active' => $this->faker->boolean,
        ];
    }
}
