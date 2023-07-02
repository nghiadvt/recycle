<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ward_id' => 1,
            'name' => $this->faker->name(),
            'address1' => $this->faker->address(),
            'address2' => $this->faker->address(),
            'zip_no' => $this->faker->numberBetween(1, 3),
            'status' => Area::ACTIVE,
        ];
    }
}
