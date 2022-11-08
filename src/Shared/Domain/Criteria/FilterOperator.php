<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

enum FilterOperator: string
{
    case EQ = '=';
    case NE = '!=';
    case GT = '>';
    case GTE = '>=';
    case LT = '<';
    case LTE = '<=';

    public static function operator(string $operator): self
    {
        return match ($operator) {
            self::NE->value => self::NE,
            self::GT->value => self::GT,
            self::GTE->value => self::GTE,
            self::LT->value  => self::LT,
            self::LTE->value => self::LTE,
            default => self::EQ,
        };
    }
}
