<?php

namespace App\Enums;

enum UserRole: string
{
    case Listener = 'listener';
    case Artist = 'artist';
    case Admin = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::Listener => 'Слушатель',
            self::Artist => 'Исполнитель',
            self::Admin => 'Администратор',
        };
    }
}
