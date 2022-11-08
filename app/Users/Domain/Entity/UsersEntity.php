<?php

namespace App\Users\Domain\Entity;

use App\Shared\Domain\Collection\Collection;

class UsersEntity extends Collection
{
    protected function type(): string
    {
        return UserEntity::class;
    }
}
