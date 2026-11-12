<?php

namespace Database\Seeders;

use App\Enums\TrackStatus;
use App\Models\Comment;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $tracks = Track::where('status', TrackStatus::Published)->get();

        for ($i = 0; $i < 15; $i++) {
            Comment::factory()->create([
                'user_id' => $users->random()->id,
                'track_id' => $tracks->random()->id,
            ]);
        }
    }
}
