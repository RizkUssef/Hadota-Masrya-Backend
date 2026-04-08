<?php

namespace Database\Factories;

use App\Models\MediaFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<MediaFile>
 */
class MediaFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['IMAGE', 'VIDEO', 'AUDIO', 'FILE']);

        return [
            'uuid' => (string) Str::uuid(),
            'uploaded_by' => User::factory(),
            'disk' => fake()->randomElement(['S3', 'LOCAL']),
            'path' => 'uploads/' . fake()->uuid() . '/' . fake()->lexify('file-????'),
            'url' => fake()->url(),
            'type' => $type,
            'mime_type' => match ($type) {
                'IMAGE' => fake()->randomElement(['image/jpeg', 'image/png']),
                'VIDEO' => 'video/mp4',
                'AUDIO' => 'audio/mpeg',
                default => 'application/pdf',
            },
            'size' => fake()->numberBetween(50_000, 25_000_000),
            'hash' => fake()->optional()->sha256(),
            'width' => $type === 'IMAGE' || $type === 'VIDEO' ? fake()->numberBetween(320, 1920) : null,
            'height' => $type === 'IMAGE' || $type === 'VIDEO' ? fake()->numberBetween(240, 1080) : null,
            'duration' => $type === 'VIDEO' || $type === 'AUDIO' ? fake()->numberBetween(5, 3600) : null,
            'is_processed' => fake()->randomElement(['TRUE', 'FALSE']),
        ];
    }
}
