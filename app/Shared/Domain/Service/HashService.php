<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

final class HashService
{
    public static function make(string $value): string
    {
        return bcrypt($value);
    }
}
