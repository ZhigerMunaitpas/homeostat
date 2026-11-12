<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'track_id' => Track::factory(),
            'body' => fake('ru_RU')->realText(fake()->numberBetween(40, 180)),
        ];
    }
}
