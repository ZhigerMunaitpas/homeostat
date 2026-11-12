<?php

namespace Database\Seeders;

use App\Enums\TrackStatus;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $tracks = Track::where('status', TrackStatus::Published)->get();

        // Лайки через связь многие ко многим users ↔ tracks (таблица likes)
        foreach (User::all() as $user) {
            $liked = $tracks->random(fake()->numberBetween(1, min(4, $tracks->count())));
            $user->likedTracks()->attach($liked->pluck('id'));
        }
    }
}
