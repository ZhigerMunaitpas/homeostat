<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Рок', 'Поп', 'Хип-хоп', 'Электроника', 'Джаз', 'Классика', 'Инди', 'Металл'];

        foreach ($names as $name) {
            Genre::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
