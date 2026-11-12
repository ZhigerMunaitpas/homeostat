<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
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
            'created_at' => $this->created_at,
            'owner' => new UserResource($this->whenLoaded('owner')),
            'tracks' => TrackResource::collection($this->whenLoaded('tracks')),
            'tracks_count' => $this->whenCounted('tracks'),
        ];
    }
}
