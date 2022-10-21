<?php

declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityId;

interface UserRepositoryInterface
{
    public function create(UserEntity $userEntity): void;

    public function getByUuid(UserEntityId $id): UserEntity;
}
