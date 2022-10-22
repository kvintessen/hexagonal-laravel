<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Eloquent\Repository;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\Users\Infrastructure\Persistence\Mapper\UserMapper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class DbUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly UserModel|Builder $model,
    ) {}

    public function create(UserEntity $userEntity): void
    {
        $userModel = UserMapper::mapToModel($userEntity);
        DB::beginTransaction();
        $userModel->save();
        DB::commit();
    }

    public function getByUuid(UserEntityId $id): UserEntity
    {
        return UserMapper::mapToDomain($this->model->where([UserModel::FIELD_UUID => $id->value()]));
    }

    public function getByEmail(UserEntityEmail $email): ?UserEntity
    {
        $userEntity = $this->model->where([UserModel::FIELD_EMAIL => $email->value()]);

        if (!$userEntity) {
            return null;
        }

        return UserMapper::mapToDomain($userEntity);
    }
}
