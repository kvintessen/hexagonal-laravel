<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Adapter;

use App\Shared\Domain\Bus\Query\Response;
use App\Users\Application\DTO\UsersDTO;
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

    public function getByEmail(string $email): Response
    {
        return $this->api->getByEmail($email);
    }

    public function search(
        ?array $filters,
        ?string $orderBy,
        ?string $order,
        ?int $limit,
        ?int $offset
    ): UsersDTO {
        return $this->api->search($filters, $orderBy, $order, $limit, $offset);
    }
}
