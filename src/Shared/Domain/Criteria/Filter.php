<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

final class Filter
{
    public function __construct(
        private readonly string $field,
        private readonly FilterOperator $operator,
        private readonly mixed $value
    ) {
    }

    public function field(): string
    {
        return $this->field;
    }

    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    public function value(): mixed
    {
        return $this->value;
    }

    public static function fromString(string $filter): self
    {
        preg_match_all('\'[\\!\\p{Sm}]\'', $filter, $matches);
        $operator = implode('', $matches[0]);
        $field = stristr($filter, $operator, true);
        $value = match ($operator) {
            '>=', '<=', '!=' => substr($filter, strpos($filter, $operator) + 2, strlen($filter)),
            default => substr($filter, strpos($filter, $operator) + 1, strlen($filter))
        };

        return new self($field, FilterOperator::operator($operator), $value);
    }
}
