<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

final class Order
{
    public function __construct(
        private readonly ?string $orderBy,
        private readonly OrderType $type
    ) {
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }

    public function type(): OrderType
    {
        return $this->type;
    }
}
