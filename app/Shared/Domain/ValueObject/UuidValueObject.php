<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class UuidValueObject
{
    public function __construct(
        protected string $value,
    ) {}

    public static function fromValue(string $value): static
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
