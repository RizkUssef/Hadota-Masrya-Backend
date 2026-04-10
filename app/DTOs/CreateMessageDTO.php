<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use DateTime;

class CreateMessageDTO
{
    public function __construct(
        public readonly int $conversation_id,
        public readonly string $content,
        public readonly ?int $user_id = null,
        public readonly ?int $reply_to_id = null,
        public readonly string $type = 'TEXT',
        public readonly ?array $metadata = null,
        public readonly DateTime $sent_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            conversation_id: $data['conversation_id'],
            content: $data['content'],
            user_id: $data['user_id'] ?? null,
            reply_to_id: $data['reply_to_id'] ?? null,
            type: $data['type'] ?? 'TEXT',
            metadata: $data['metadata'] ?? null,
            sent_at: isset($data['sent_at']) ? new DateTime($data['sent_at']) : null,
        );
    }
    public static function fromMessage(Request $request): self
    {
        return self::fromArray($request->validated());
    }

    public function toArray(): array
    {
        return [
            'conversation_id' => $this->conversation_id,
            'content' => $this->content,
            'user_id' => $this->user_id,
            'reply_to_id' => $this->reply_to_id,
            'type' => $this->type,
            'metadata' => $this->metadata,
            'sent_at' => $this->sent_at?->format('Y-m-d H:i:s'),
        ];
    }
}
