<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

final class Criteria
{
    public function __construct(
        private readonly Filters $filters,
        private readonly Order $order,
        private readonly ?int $offset,
        private readonly ?int $limit
    ) {
    }

    public function filters(): Filters
    {
        return $this->filters;
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }
}
