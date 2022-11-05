<?php

declare(strict_types=1);

namespace Tests\Users\Domain\Entity;

use App\Users\Domain\Entity\UserEntityLogin;

final class UserEntityLoginMother
{
    public static function create(?string $value = null): UserEntityLogin
    {
        return UserEntityLogin::fromValue($value ?? UserEntityLogin::random('login')->value());
    }
}
