<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Тестовые учётные записи (пароль у всех: password).
     */
    public const ACCOUNTS = [
        ['name' => 'Администратор', 'email' => 'admin@homeostat.test', 'role' => UserRole::Admin],
        ['name' => 'Алексей Исполнитель', 'email' => 'artist@homeostat.test', 'role' => UserRole::Artist],
        ['name' => 'Мария Слушатель', 'email' => 'listener@homeostat.test', 'role' => UserRole::Listener],
    ];

    public function run(): void
    {
        foreach (self::ACCOUNTS as $account) {
            User::factory()->create($account + ['password' => 'password']);
        }

        User::factory()->artist()->count(4)->create();
        User::factory()->listener()->count(5)->create();
        User::factory()->listener()->blocked()->create([
            'name' => 'Заблокированный Пользователь',
            'email' => 'blocked@homeostat.test',
        ]);
    }
}
