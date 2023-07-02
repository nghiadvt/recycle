<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceArticle>
 */
class ServiceArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'services_category_id' => 1,
            'services_id' => 1,
            'title' => $this->faker->name,
            'slug' => $this->faker->slug,
            'active' => $this->faker->boolean,
        ];
    }
}
