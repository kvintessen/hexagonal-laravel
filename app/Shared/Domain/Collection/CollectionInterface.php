<?php

declare(strict_types=1);

namespace App\Shared\Domain\Collection;

interface CollectionInterface
{
    public function all(): array;
}
