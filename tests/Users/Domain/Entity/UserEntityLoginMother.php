<?php

declare(strict_types=1);

namespace Tests\Users\Domain\Entity;

use App\Shared\Infrastructure\Facade\FakerServiceFacade;
use App\Users\Domain\Entity\UserEntityLogin;

final class UserEntityLoginMother
{
    public static function create(?string $value = null): UserEntityLogin
    {
        return UserEntityLogin::fromValue($value ?? FakerServiceFacade::generate('login'));
    }
}
