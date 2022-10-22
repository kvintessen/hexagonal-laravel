<?php

declare(strict_types=1);

namespace Tests\Users\Domain\Entity;

use App\Shared\Domain\Service\FakerService;
use App\Users\Domain\Entity\UserEntityEmail;

final class UserEntityEmailMother
{
    public static function create(?string $value = null): UserEntityEmail
    {
        return UserEntityEmail::fromValue($value ?? FakerService::generate('safeEmail'));
    }
}