<?php

namespace App\Enums;

enum TrackStatus: string
{
    case Pending = 'pending';
    case Published = 'published';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'На модерации',
            self::Published => 'Опубликован',
            self::Rejected => 'Отклонён',
        };
    }
}
