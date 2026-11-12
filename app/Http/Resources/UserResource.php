<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Пароль и токены намеренно не возвращаются.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'bio' => $this->bio,
            'avatar_path' => $this->avatar_path,
            'is_blocked' => $this->is_blocked,
            'created_at' => $this->created_at,
            'tracks' => TrackResource::collection($this->whenLoaded('tracks')),
            'playlists' => PlaylistResource::collection($this->whenLoaded('playlists')),
            'followers_count' => $this->whenCounted('followers'),
            'following_count' => $this->whenCounted('following'),
        ];
    }
}
