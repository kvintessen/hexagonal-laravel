<?php

declare(strict_types=1);

namespace Tests\Users\Domain\Entity;

use App\Shared\Infrastructure\Facade\FakerServiceFacade;
use App\Users\Domain\Entity\UserEntityPassword;

final class UserEntityPasswordMother
{
    public static function create(?string $value = null): UserEntityPassword
    {
        return UserEntityPassword::fromValue($value ?? FakerServiceFacade::generate('password'));
    }
}
