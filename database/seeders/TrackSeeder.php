<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Genre;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    public function run(): void
    {
        $artists = User::where('role', UserRole::Artist)->get();
        $genres = Genre::all();

        // Каждому исполнителю — по 2 опубликованных трека
        foreach ($artists as $artist) {
            Track::factory()->count(2)->published()->create([
                'user_id' => $artist->id,
                'genre_id' => $genres->random()->id,
            ]);
        }

        // Треки на модерации и отклонённые для очереди модерации
        Track::factory()->count(2)->pending()->create([
            'user_id' => $artists->random()->id,
            'genre_id' => $genres->random()->id,
        ]);
        Track::factory()->rejected()->create([
            'user_id' => $artists->random()->id,
            'genre_id' => $genres->random()->id,
        ]);
    }
}
