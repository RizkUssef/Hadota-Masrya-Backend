<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\ConversationMember;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ConversationMember>
 */
class ConversationMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conversation_id' => Conversation::factory(),
            'user_id' => User::factory(),
            'role' => fake()->randomElement(['OWNER', 'ADMIN', 'MEMBER']),
            'nickname' => fake()->optional()->firstName(),
            'is_muted' => fake()->randomElement(['TRUE', 'FALSE']),
            'muted_until' => fake()->optional()->dateTimeBetween('now', '+7 days'),
            'is_pinned' => fake()->randomElement(['TRUE', 'FALSE']),
            'unread_count' => fake()->numberBetween(0, 25),
            'last_read_at' => fake()->optional()->dateTimeBetween('-3 days', 'now'),
            'last_read_message_id' => null,
            'joined_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'left_at' => null,
            'invited_by' => User::factory(),
        ];
    }
}
