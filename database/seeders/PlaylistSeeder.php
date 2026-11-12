<?php

namespace Database\Seeders;

use App\Enums\TrackStatus;
use App\Models\Playlist;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $published = Track::where('status', TrackStatus::Published)->get();

        for ($i = 0; $i < 6; $i++) {
            $playlist = Playlist::factory()->create(['user_id' => $users->random()->id]);

            // Связь «многие ко многим» playlist_track с позицией трека
            $tracks = $published->random(min(4, $published->count()));
            $attach = [];
            foreach ($tracks->values() as $position => $track) {
                $attach[$track->id] = ['position' => $position + 1];
            }
            $playlist->tracks()->attach($attach);
        }
    }
}
