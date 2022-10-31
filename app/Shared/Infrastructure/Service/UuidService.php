<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Service;

use App\Shared\Domain\Service\UuidServiceInterface;
use Illuminate\Support\Str;

final class UuidService implements UuidServiceInterface
{
    public function generate(): string
    {
        return Str::uuid()->toString();
    }
}
