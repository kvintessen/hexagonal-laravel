<?php

declare(strict_types=1);

namespace Tests\Users\Application\Command\Create;

use App\Users\Application\Command\Create\CreateUserCommand;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityLogin;
use App\Users\Domain\Entity\UserEntityPassword;
use Tests\Users\Domain\Entity\UserEntityMother;

class CreateUserCommandMother
{
    public static function create(
        ?UserEntityLogin $login = null,
        ?UserEntityEmail $email = null,
        ?UserEntityPassword $password = null,
    ): CreateUserCommand {
        $userEntity = UserEntityMother::create(login: $login, email: $email, password: $password);

        return new CreateUserCommand(
            $userEntity->getLogin()->value(),
            $userEntity->getEmail()->value(),
            $userEntity->getPassword()->value()
        );
    }
}
