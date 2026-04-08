<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\TypingIndicator;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TypingIndicator>
 */
class TypingIndicatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedAt = fake()->dateTimeBetween('-5 minutes', 'now');

        return [
            'conversation_id' => Conversation::factory(),
            'user_id' => User::factory(),
            'started_at' => $startedAt,
            'expires_at' => fake()->dateTimeBetween($startedAt, '+2 minutes'),
        ];
    }
}
