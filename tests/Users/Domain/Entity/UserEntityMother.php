<?php

declare(strict_types=1);

namespace Tests\Users\Domain\Entity;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Entity\UserEntityLogin;
use App\Users\Domain\Entity\UserEntityPassword;

final class UserEntityMother
{
    public static function create(
        ?UserEntityId $id = null,
        ?UserEntityLogin $login = null,
        ?UserEntityEmail $email = null,
        ?UserEntityPassword $password = null
    ): UserEntity {
        return UserEntity::fromPrimitives(
            $id?->value() ?? UserEntityIdMother::create()->value(),
            $login?->value() ?? UserEntityLoginMother::create()->value(),
            $email?->value() ?? UserEntityEmailMother::create()->value(),
            $password?->value() ?? UserEntityPasswordMother::create()->value()
        );
    }
}
