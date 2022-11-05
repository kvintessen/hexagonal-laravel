<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Service\UuidService;
use InvalidArgumentException;

class UuidValueObject
{
    private string $value;

    final public function __construct(string $value)
    {
        $this->assertIsValidUuid($value);
        $this->value = $value;
    }

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

    private function assertIsValidUuid(string $id): void
    {
        if (!UuidService::isUuid($id)) {
            throw new InvalidArgumentException(
                sprintf('`<%s>` does not allow the value `<%s>`.', static::class, $id)
            );
        }
    }
}
