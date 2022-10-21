<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Eloquent\Repository;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\Users\Infrastructure\Persistence\Mapper\UserMapper;
use Illuminate\Database\Eloquent\Builder;

final class DbUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly UserModel|Builder $model,
    ) {}

    public function create($userData): void
    {
        $this->model->create($userData);
    }

    public function getByUuid(UserEntityId $id): UserEntity
    {
        return UserMapper::mapToDomain($this->model->where(['uuid' => $id->value()]));
    }
}
