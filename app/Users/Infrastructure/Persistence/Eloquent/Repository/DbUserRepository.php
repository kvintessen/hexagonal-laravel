<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Eloquent\Repository;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\Users\Infrastructure\Persistence\Mapper\UserMapper;
use Illuminate\Support\Facades\DB;
use Throwable;

final class DbUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly UserModel $model,
    ) {
    }

    /**
     * @throws Throwable
     */
    public function create(UserEntity $userEntity): void
    {
        $userModel = UserMapper::mapToModel($userEntity);
        DB::beginTransaction();
        $userModel->save();
        DB::commit();
    }

    public function getByUuid(UserEntityId $id): UserEntity
    {
        /** @var UserModel $userModel */
        $userModel = $this->model->where([UserModel::FIELD_UUID => $id->value()])->first();

        return UserMapper::mapToDomain($userModel);
    }

    public function getByEmail(UserEntityEmail $email): ?UserEntity
    {
        /** @var UserModel|null $userModel */
        $userModel = $this->model->where([UserModel::FIELD_EMAIL => $email->value()])->firstOrFail();

        if (!$userModel) {
            return null;
        }

        return UserMapper::mapToDomain($userModel);
    }
}
