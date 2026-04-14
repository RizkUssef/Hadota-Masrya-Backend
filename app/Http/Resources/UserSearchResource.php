<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSearchResource extends JsonResource
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
            'username' => $this->username,
            'display_name' => $this->display_name,
            'avatar_url' => $this->avatar_url,
            'bio' => $this->bio,
            "is_online" => $this->is_online,
            "status" => $this->status,
        ];
    }
}
