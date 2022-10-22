<?php

declare(strict_types=1);

namespace Tests\Users\Application\Query\GetByEmail;

use App\Users\Application\Query\GetByEmail\GetUserByEmailQuery;
use App\Users\Domain\Entity\UserEntityEmail;

class GetUserByEmailQueryMother
{
    public static function create(UserEntityEmail $email): GetUserByEmailQuery
    {
        return new GetUserByEmailQuery(
            $email->value()
        );
    }
}
