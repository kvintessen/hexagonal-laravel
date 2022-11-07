<?php

declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Entity\UsersEntity;

interface UserRepositoryInterface
{
    public function create(UserEntity $userEntity): void;

    public function getByUuid(UserEntityId $id): UserEntity;

    public function getByEmail(UserEntityEmail $email): ?UserEntity;

    public function search(Criteria $criteria): UsersEntity;
}
