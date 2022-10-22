<?php

declare(strict_types=1);

namespace App\Shared\Domain\Query;

use App\Users\Application\DTO\UserDTO;
use App\Users\Application\Query\GetByEmail\GetUserByEmailQuery;

interface QueryHandlerInterface
{
    public function __invoke(GetUserByEmailQuery $query): ?UserDTO;
}
