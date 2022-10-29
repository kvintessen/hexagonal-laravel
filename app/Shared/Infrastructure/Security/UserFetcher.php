<?php

namespace App\Shared\Infrastructure\Security;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Users\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\Users\Infrastructure\Persistence\Mapper\UserMapper;
use Illuminate\Support\Facades\Auth;
use Webmozart\Assert\Assert;

final class UserFetcher implements UserFetcherInterface
{
    public function getAuthUser(): AuthUserInterface
    {
        /** @var UserModel $userModel */
        $userModel = Auth::user();

        /** @var AuthUserInterface $userEntity */
        $userEntity = UserMapper::mapToDomain($userModel);

        Assert::notNull($userEntity, 'Current user not found check security access list');
        Assert::isInstanceOf(
            $userEntity,
            AuthUserInterface::class,
            sprintf('Invalid user type %s', \get_class($userEntity))
        );

        return $userEntity;
    }
}
