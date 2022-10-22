<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Service\UuidService;

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

    public static function random(): static
    {
        return new static(UuidService::generate());
    }
}
