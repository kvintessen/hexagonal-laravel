<?php

declare(strict_types=1);

namespace App\Users\Domain\Entity;

final class UserEntity
{
    public function __construct(
        private readonly UserEntityId       $uuid,
        private readonly UserEntityLogin    $login,
        private readonly UserEntityEmail    $email,
        private readonly UserEntityPassword $password,
    ) {}

    public function getUuid(): UserEntityId
    {
        return $this->uuid;
    }

    public function getLogin(): UserEntityLogin
    {
        return $this->login;
    }

    public function getEmail(): UserEntityEmail
    {
        return $this->email;
    }

    public function getPassword(): UserEntityPassword
    {
        return $this->password;
    }
}
