<?php

namespace App\Shared\Domain\Security;

interface AuthUserInterface
{
    public function uuid(): string;

    public function login(): string;

    public function email(): string;

    public function getRoles(): array;

    public function toArray(): array;

    public function eraseCredentials(): void;

    public function getUserIdentifier(): string;
}
