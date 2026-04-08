<?php

namespace Database\Factories;

use App\Models\MediaFile;
use App\Models\MessageAttachment;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MessageAttachment>
 */
class MessageAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message_id' => Message::factory(),
            'media_file_id' => fake()->boolean(70) ? MediaFile::factory() : null,
            'type' => fake()->randomElement(['IMAGE', 'VIDEO', 'AUDIO', 'FILE']),
            'url' => fake()->url(),
            'thumbnail_url' => fake()->optional()->imageUrl(320, 240),
            'file_name' => fake()->optional()->word() . '.jpg',
            'file_size' => fake()->numberBetween(10_000, 8_000_000),
            'mime_type' => fake()->randomElement(['image/jpeg', 'image/png', 'video/mp4', 'application/pdf']),
            'width' => fake()->optional()->numberBetween(320, 1920),
            'height' => fake()->optional()->numberBetween(240, 1080),
            'duration' => fake()->optional()->numberBetween(5, 600),
            'sort_order' => (string) fake()->numberBetween(0, 5),
        ];
    }
}
