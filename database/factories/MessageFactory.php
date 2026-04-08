<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'conversation_id' => Conversation::factory(),
            'user_id' => User::factory(),
            'reply_to_id' => null,
            'type' => fake()->randomElement(['TEXT', 'IMAGE', 'VIDEO', 'FILE']),
            'content' => fake()->optional()->paragraph(),
            'metadata' => json_encode([
                'key' => fake()->word(),
                'value' => fake()->sentence(),
            ]),
            'is_edited' => fake()->randomElement(['TRUE', 'FALSE']),
            'edited_at' => fake()->optional()->dateTimeBetween('-2 days', 'now'),
            'is_deleted' => fake()->randomElement(['TRUE', 'FALSE']),
            'sent_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
