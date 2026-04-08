<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserSetting>
 */
class UserSettingFactory extends Factory
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
            'theme' => fake()->randomElement(['LIGHT', 'DARK']),
            'language' => fake()->randomElement(['EN', 'AR']),
            'notification_sound' => fake()->randomElement(['TRUE', 'FALSE']),
            'notification_preview' => fake()->randomElement(['TRUE', 'FALSE']),
            'read_receipts' => fake()->randomElement(['TRUE', 'FALSE']),
            'typing_indicators' => fake()->randomElement(['TRUE', 'FALSE']),
            'online_status_visible' => fake()->randomElement(['TRUE', 'FALSE']),
            'two_factor_enabled' => fake()->randomElement(['TRUE', 'FALSE']),
            'two_factor_secret' => fake()->optional()->regexify('[A-Z0-9]{32}'),
        ];
    }
}
