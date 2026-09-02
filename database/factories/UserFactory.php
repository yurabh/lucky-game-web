<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'username' => fake()->userName(),
            'phone' => fake()->phoneNumber(),
            'link' => Str::random(64),
            'expires_at' => now()->addDays(7),
            'is_active' => true,
        ];
    }
}
