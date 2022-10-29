<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Service;

use App\Users\Domain\Service\HashServiceInterface;

final class HashService implements HashServiceInterface
{
    public function make(string $value): string
    {
        return bcrypt($value);
    }
}
