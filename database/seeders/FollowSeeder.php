<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    public function run(): void
    {
        $artists = User::where('role', UserRole::Artist)->get();

        // Подписки пользователей на исполнителей (users ↔ users через follows)
        foreach (User::where('role', '!=', UserRole::Admin)->get() as $user) {
            $targets = $artists->where('id', '!=', $user->id);
            if ($targets->isEmpty()) {
                continue;
            }

            $user->following()->attach(
                $targets->random(fake()->numberBetween(1, min(3, $targets->count())))->pluck('id')
            );
        }
    }
}
