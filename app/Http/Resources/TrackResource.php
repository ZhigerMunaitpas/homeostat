<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'audio_path' => $this->audio_path,
            'cover_path' => $this->cover_path,
            'duration' => $this->duration,
            'plays_count' => $this->plays_count,
            'status' => $this->status,
            'reject_reason' => $this->reject_reason,
            'created_at' => $this->created_at,
            'artist' => new UserResource($this->whenLoaded('artist')),
            'genre' => new GenreResource($this->whenLoaded('genre')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'likes_count' => $this->whenCounted('likes'),
            'comments_count' => $this->whenCounted('comments'),
            // Позиция трека, когда ресурс отдаётся в составе плейлиста
            'position' => $this->whenPivotLoaded('playlist_track', fn () => $this->pivot->position),
        ];
    }
}
