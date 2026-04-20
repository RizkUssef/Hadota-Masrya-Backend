<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationMemberItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => new UserItemResource($this->whenLoaded('user')),
            'role' => $this->role,
            'nickname' => $this->nickname,
            'is_muted' => $this->is_muted,
            'muted_until' => $this->muted_until,
            'is_pinned' => $this->is_pinned,
            'unread_count' => $this->unread_count,
            'last_read_at' => $this->last_read_at,
            'last_read_message_id' => $this->last_read_message_id,
            'joined_at' => $this->joined_at,
            'left_at' => $this->left_at,
            'invited_by' => $this->invited_by,
        ];
    }
}
