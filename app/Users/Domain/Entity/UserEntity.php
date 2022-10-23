<?php

declare(strict_types=1);

namespace App\Users\Domain\Entity;

use App\Shared\Domain\Security\AuthUserInterface;

final class UserEntity implements AuthUserInterface
{
    public function __construct(
        private readonly UserEntityId $uuid,
        private readonly UserEntityLogin $login,
        private readonly UserEntityEmail $email,
        private readonly UserEntityPassword $password,
    ) {
    }

    public static function fromPrimitives(string $uuid, string $login, string $email, string $password): self
    {
        return new self(
            UserEntityId::fromValue($uuid),
            UserEntityLogin::fromValue($login),
            UserEntityEmail::fromValue($email),
            UserEntityPassword::fromValue($password),
        );
    }

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
    
    /** 
     * @return array<string> 
     */
    public function getRoles(): array
    {
        return [
            'ROLE_USER',
        ];
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail()->value();
    }

    public function uuid(): string
    {
        return $this->getUuid()->value();
    }

    public function login(): string
    {
        return $this->getLogin()->value();
    }

    public function email(): string
    {
        return $this->getEmail()->value();
    }
}
