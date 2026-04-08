<?php

namespace Database\Seeders;

use App\Models\BlockedUser;
use App\Models\Contact;
use App\Models\Conversation;
use App\Models\ConversationMember;
use App\Models\MediaFile;
use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\MessageRead;
use App\Models\MessageReaction;
use App\Models\PushToken;
use App\Models\TypingIndicator;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(12)->create();

        $demoUser = User::factory()->create([
            'username' => 'testuser',
            'email' => 'test@example.com',
            'display_name' => 'Test User',
            'status' => 'ACTIVE',
            'is_online' => 'TRUE',
        ]);

        $users = $users->prepend($demoUser)->values();

        $users->each(function (User $user) {
            UserSetting::factory()->create([
                'user_id' => $user->id,
            ]);

            PushToken::factory(fake()->numberBetween(1, 2))->create([
                'user_id' => $user->id,
            ]);
        });

        $users->each(function (User $user) use ($users) {
            $contacts = $users
                ->where('id', '!=', $user->id)
                ->shuffle()
                ->take(fake()->numberBetween(2, 4));

            foreach ($contacts as $contact) {
                Contact::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'contact_id' => $contact->id,
                    ],
                    [
                        'nickname' => fake()->optional()->firstName(),
                        'is_favorite' => fake()->randomElement(['TRUE', 'FALSE']),
                    ]
                );
            }
        });

        $users->shuffle()->take(4)->each(function (User $blocker) use ($users) {
            $blocked = $users
                ->where('id', '!=', $blocker->id)
                ->shuffle()
                ->first();

            if (! $blocked) {
                return;
            }

            BlockedUser::firstOrCreate(
                [
                    'blocker_id' => $blocker->id,
                    'blocked_id' => $blocked->id,
                ],
                [
                    'reason' => fake()->optional()->sentence(),
                ]
            );
        });

        $directConversations = collect();

        for ($index = 0; $index < 4; $index++) {
            $members = $users->shuffle()->take(2)->values();
            $conversation = Conversation::factory()->create([
                'type' => 'DIRECT',
                'name' => null,
                'description' => null,
                'created_by' => $members->first()->id,
            ]);

            $this->seedConversationMembers($conversation, $members);
            $this->seedConversationContent($conversation, $members, fake()->numberBetween(5, 9));

            $directConversations->push($conversation);
        }

        $groupConversations = collect();

        for ($index = 0; $index < 3; $index++) {
            $members = $users->shuffle()->take(fake()->numberBetween(3, 5))->values();
            $owner = $members->first();

            $conversation = Conversation::factory()->create([
                'type' => 'GROUP',
                'name' => fake()->words(3, true),
                'description' => fake()->sentence(),
                'created_by' => $owner->id,
            ]);

            $this->seedConversationMembers($conversation, $members, $owner->id);
            $this->seedConversationContent($conversation, $members, fake()->numberBetween(8, 14));

            $groupConversations->push($conversation);
        }

        $allConversations = $directConversations->concat($groupConversations);

        $allConversations->each(function (Conversation $conversation) {
            $activeMember = $conversation->members()->inRandomOrder()->first();

            if (! $activeMember) {
                return;
            }

            TypingIndicator::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $activeMember->user_id,
            ]);
        });
    }

    private function seedConversationMembers(Conversation $conversation, Collection $members, ?int $ownerId = null): void
    {
        foreach ($members as $position => $member) {
            ConversationMember::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $member->id,
                'role' => $ownerId !== null && $member->id === $ownerId
                    ? 'OWNER'
                    : ($position === 0 ? 'ADMIN' : 'MEMBER'),
                'nickname' => fake()->optional()->firstName(),
                'last_read_message_id' => null,
                'invited_by' => $ownerId ?? $members->first()->id,
            ]);
        }
    }

    private function seedConversationContent(Conversation $conversation, Collection $members, int $messageCount): void
    {
        $messages = collect();

        for ($index = 0; $index < $messageCount; $index++) {
            $sender = $members->random();
            $message = Message::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $sender->id,
                'reply_to_id' => $messages->isNotEmpty() && fake()->boolean(25)
                    ? $messages->random()->id
                    : null,
            ]);

            if (in_array($message->type, ['IMAGE', 'VIDEO', 'FILE', 'AUDIO'], true) || fake()->boolean(30)) {
                $media = MediaFile::factory()->create([
                    'uploaded_by' => $sender->id,
                ]);

                MessageAttachment::factory()->create([
                    'message_id' => $message->id,
                    'media_file_id' => $media->id,
                    'type' => $media->type,
                    'url' => $media->url,
                    'mime_type' => $media->mime_type,
                    'file_size' => $media->size,
                    'width' => $media->width,
                    'height' => $media->height,
                    'duration' => $media->duration,
                ]);
            }

            $readers = $members->where('id', '!=', $sender->id)->shuffle()->take(fake()->numberBetween(1, $members->count() - 1));

            foreach ($readers as $reader) {
                MessageRead::factory()->create([
                    'message_id' => $message->id,
                    'user_id' => $reader->id,
                ]);
            }

            $reactors = $members->shuffle()->take(fake()->numberBetween(0, min(3, $members->count())));

            foreach ($reactors as $reactor) {
                MessageReaction::factory()->create([
                    'message_id' => $message->id,
                    'user_id' => $reactor->id,
                ]);
            }

            $messages->push($message);
        }

        $lastMessage = $messages->last();

        if ($lastMessage) {
            $conversation->update([
                'last_message_id' => $lastMessage->id,
                'last_activity_at' => $lastMessage->sent_at,
            ]);
        }
    }
}
