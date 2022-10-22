<?php

declare(strict_types=1);

namespace App\Users\Application\Query\GetByEmail;

use App\Shared\Domain\Query\QueryInterface;

class GetUserByEmailQuery implements QueryInterface
{
    public function __construct(public readonly string $email) {}
}
