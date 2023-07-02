<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'login_id' => function () {
                return Admin::factory()->create()->id;
            },
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_login' => $this->faker->unique()->safeEmail(),
            'password' => \Hash::make('password'),
            'login_type' => 'admin',
            'confirmation_code' => 'admin'
        ];
    }
}
