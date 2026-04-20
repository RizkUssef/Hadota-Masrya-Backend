<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'avatar_url' => $this->avatar_url,
            'created_by' => $this->created_by,
            'members' => $this->whenLoaded('members', function () {
                return ConversationMemberResource::collection($this->members);
            }),
            'other_users' => $this->whenLoaded('members', function () {
                return ConversationMemberItemResource::collection(
                    $this->members->filter(function ($member) {
                        return $member->user_id != Auth::id();
                    })->map(function ($member) {
                        return $member;
                    })
                );
            }),
            // 'other_user' => new UserResource($otherUser),
            'last_message_id' => $this->last_message_id,
            'last_message' => $this->whenLoaded('lastMessage', function () {
                return new MessageResource($this->lastMessage);
            }),
            'last_activity_at' => $this->last_activity_at,
            'is_archived' => $this->is_archived,
        ];
    }
}
