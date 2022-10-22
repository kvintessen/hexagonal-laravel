<?php

declare(strict_types=1);

namespace App\Shared\Domain\Query;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): ?Response;
}
