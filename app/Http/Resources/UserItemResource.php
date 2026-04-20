<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'display_name' => $this->display_name,
            'avatar_url' => $this->avatar_url,
            'bio' => $this->bio,
            'status' => $this->status,
            'is_online' => $this->is_online,
            'last_seen_at' => $this->last_seen_at,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
        ];
    }
}
