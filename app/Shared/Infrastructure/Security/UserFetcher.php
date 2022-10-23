<?php

namespace App\Shared\Infrastructure\Security;

use App\Shared\Domain\Security\AuthUserInterface;
use Illuminate\Support\Facades\Auth;
use Webmozart\Assert\Assert;

final class UserFetcher implements \App\Shared\Domain\Security\UserFetcherInterface
{

    public function getAuthUser(): AuthUserInterface
    {
        /** @var AuthUserInterface $user */
        $user = Auth::user();
        Assert::notNull($user, 'Current user not found check security access list');
        Assert::isInstanceOf($user,
            AuthUserInterface::class,
            sprintf('Invalid user type %s', \get_class($user))
        );

        return $user;
    }
}
