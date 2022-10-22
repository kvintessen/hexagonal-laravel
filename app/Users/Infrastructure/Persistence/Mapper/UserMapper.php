<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Mapper;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Infrastructure\Persistence\Eloquent\Model\UserModel;

final class UserMapper
{
    public static function mapToDomain(UserModel $userModel): UserEntity
    {
        return UserEntity::fromPrimitives(
            $userModel->uuid,
            $userModel->login,
            $userModel->email,
            $userModel->password,
        );
    }

    public static function mapToModel(UserEntity $userEntity): UserModel
    {
        $user = new UserModel();

        $user->uuid     = $userEntity->getUuid()->value();
        $user->login    = $userEntity->getLogin()->value();
        $user->email    = $userEntity->getEmail()->value();
        $user->password = $userEntity->getPassword()->value();

        return $user;
    }
}
