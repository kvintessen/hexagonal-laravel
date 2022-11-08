<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

final class HashService
{
    public static function hash(string $value): string
    {
        return password_hash($value, PASSWORD_DEFAULT );
    }
}
