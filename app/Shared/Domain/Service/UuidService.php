<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

use Illuminate\Support\Str;

final class UuidService
{
    public static function generate(): string
    {
        return Str::uuid()->toString();
    }
}
