<?php

declare(strict_types=1);

namespace App\Users\Domain\Entity;

use App\Shared\Domain\Service\HashService;
use App\Shared\Domain\ValueObject\StringValueObject;

final class UserEntityPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct(HashService::hash($value));
    }
}
