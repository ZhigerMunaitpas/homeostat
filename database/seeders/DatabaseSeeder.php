<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Порядок важен: родительские таблицы заполняются раньше зависимых.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GenreSeeder::class,
            TrackSeeder::class,
            PlaylistSeeder::class,
            CommentSeeder::class,
            LikeSeeder::class,
            FollowSeeder::class,
        ]);
    }
}
