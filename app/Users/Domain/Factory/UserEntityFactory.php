<?php

declare(strict_types=1);

namespace App\Users\Domain\Factory;

use App\Users\Domain\Entity\UserEntity;
use JetBrains\PhpStorm\ArrayShape;

final class UserEntityFactory
{
    #[ArrayShape([
        'uuid'     => 'string',
        'login'    => 'string',
        'email'    => 'string',
        'password' => 'string',
    ])]
    public function create(
        string $uuid,
        string $login,
        string $email,
        string $password
    ): UserEntity {
        return UserEntity::fromPrimitives(
            $uuid,
            $login,
            $email,
            $password
        );
    }
}
