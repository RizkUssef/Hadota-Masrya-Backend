<?php

namespace Database\Factories;

use App\Models\PushToken;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PushToken>
 */
class PushTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'token' => Str::random(64),
            'platform' => fake()->randomElement(['ANDROID', 'IOS', 'WEB']),
            'device_name' => fake()->optional()->randomElement(['iPhone 15', 'Samsung S24', 'Chrome on Windows']),
            'is_active' => fake()->randomElement(['TRUE', 'FALSE']),
            'last_used_at' => fake()->optional()->dateTimeBetween('-2 weeks', 'now'),
        ];
    }
}
