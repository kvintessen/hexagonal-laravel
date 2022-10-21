<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Mapper;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Entity\UserEntityLogin;
use App\Users\Domain\Entity\UserEntityPassword;
use App\Users\Infrastructure\Persistence\Eloquent\Model\UserModel;

class UserMapper
{
    public static function mapToDomain(UserModel $userModel): UserEntity
    {
        return new UserEntity(
            UserEntityId::fromValue($userModel->uuid),
            UserEntityLogin::fromValue($userModel->login),
            UserEntityEmail::fromValue($userModel->email),
            UserEntityPassword::fromValue($userModel->password),
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
