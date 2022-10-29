<?php

declare(strict_types=1);

namespace App\Users\Domain\Service;

interface UuidServiceInterface
{
    public function generate(): string;
}
