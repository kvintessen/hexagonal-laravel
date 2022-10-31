<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

interface UuidServiceInterface
{
    public function generate(): string;
}
