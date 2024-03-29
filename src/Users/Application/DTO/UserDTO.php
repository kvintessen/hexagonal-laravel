<?php

declare(strict_types=1);

namespace App\Users\Application\DTO;

use App\Shared\Domain\Bus\Query\Response;
use App\Users\Domain\Entity\UserEntity;

final class UserDTO implements Response
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $login,
        public readonly string $email
    ) {
    }

    public static function fromEntity(UserEntity $userEntity): self
    {
        return new self(
            $userEntity->getUuid()->value(),
            $userEntity->getLogin()->value(),
            $userEntity->getEmail()->value()
        );
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'login' => $this->login,
            'email' => $this->email,
        ];
    }
}
