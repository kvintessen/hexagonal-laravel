<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

interface HashServiceInterface
{
    public function hash(string $value): string;
}
