<?php

namespace App\Users\Application\DTO;

use App\Shared\Domain\Bus\Query\Response;
use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UsersEntity;

class UsersDTO implements Response
{
    /**
     * @param array<UserDTO> $users
     */
    public function __construct(private readonly array $users)
    {
    }

    public static function fromUsers(UsersEntity $users): self
    {
        $usersDTO = array_map(
            static function (UserEntity $userEntity)
            {
                return UserDTO::fromEntity($userEntity);
            },
            $users->all()
        );

        return new self($usersDTO);
    }

    public function toArray(): array
    {
        return array_map(
            static function (UserDTO $userDTO)
            {
                return $userDTO->toArray();
            },
            $this->users
        );
    }
}
