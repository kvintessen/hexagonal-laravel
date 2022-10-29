<?php

declare(strict_types=1);

namespace Tests\Users\Domain\Entity;

use App\Shared\Infrastructure\Service\FakerService;
use App\Users\Domain\Entity\UserEntityId;

final class UserEntityIdMother
{
    public static function create(?string $value = null): UserEntityId
    {
        return UserEntityId::fromValue($value ?? (new FakerService)->generate('uuid'));
    }
}
