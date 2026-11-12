<?php

namespace Database\Factories;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Playlist>
 */
class PlaylistFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->randomElement([
                'Для работы', 'Вечерний чилл', 'Тренировка', 'В дорогу',
                'Любимое', 'Утренний заряд', 'Новинки недели', 'Ностальгия',
            ]).' '.fake()->numberBetween(1, 99),
            'description' => fake('ru_RU')->optional(0.6)->realText(120),
        ];
    }
}
