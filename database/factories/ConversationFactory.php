<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Conversation>
 */
class ConversationFactory extends Factory
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
            'type' => fake()->randomElement(['DIRECT', 'GROUP']),
            'name' => fake()->optional()->words(3, true),
            'description' => fake()->optional()->sentence(),
            'avatar_url' => fake()->optional()->imageUrl(400, 400, 'people'),
            'created_by' => User::factory(),
            'last_message_id' => null,
            'last_activity_at' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'is_archived' => fake()->randomElement(['TRUE', 'FALSE']),
        ];
    }
}
