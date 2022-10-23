<?php

namespace App\Shared\Domain\Security;

use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Entity\UserEntityLogin;

interface AuthUserInterface
{
    public function getUuid(): UserEntityId;

    public function getLogin(): UserEntityLogin;

    public function getEmail(): UserEntityEmail;

    public function getRoles(): array;

    public function eraseCredentials(): void;

    public function getUserIdentifier(): string;

}
