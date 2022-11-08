<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

use App\Shared\Domain\Collection\Collection;

final class Filters extends Collection
{
    protected function type(): string
    {
        return Filter::class;
    }

    public static function fromString(?string $filters): array
    {
        if (!$filters) {
            return [];
        }

        $filters = explode(',', $filters);
        $result = [];

        foreach ($filters as $filter) {
            $result[] = Filter::fromString($filter);
        }

        return $result;
    }
}
