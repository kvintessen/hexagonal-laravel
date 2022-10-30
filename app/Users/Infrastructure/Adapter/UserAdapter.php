<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Adapter;

use App\Shared\Application\Query\Response;
use App\Users\Infrastructure\Api;

final class UserAdapter
{
    public function __construct(private readonly Api $api)
    {
    }

    public function create(string $login, string $email, string $password): void
    {
        $this->api->create($login, $email, $password);
    }

    public function getByUuid(string $email): Response
    {
        return $this->api->getByUuid($email);
    }
}
