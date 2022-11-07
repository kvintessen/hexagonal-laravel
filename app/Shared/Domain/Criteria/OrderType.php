<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

enum OrderType
{
    case Asc;
    case Desc;
    case None;

    public static function type(?string $type): self
    {
        return match ($type) {
            'ASC' => self::Asc,
            'NONE' => self::None,
            default => self::Desc
        };
    }
}
