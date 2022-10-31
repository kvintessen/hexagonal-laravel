<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Service;

use App\Shared\Domain\Service\HashServiceInterface;

final class HashService implements HashServiceInterface
{
    public function hash(string $value): string
    {
        return bcrypt($value);
    }
}
