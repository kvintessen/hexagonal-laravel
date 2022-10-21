<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

use Illuminate\Support\Facades\Hash;

final class HashService
{
    public static function make(string $value): string
    {
        return Hash::make($value);
    }
}
