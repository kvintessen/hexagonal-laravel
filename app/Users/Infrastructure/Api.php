<?php

declare(strict_types=1);

namespace App\Users\Infrastructure;

use App\Shared\Domain\Bus\Command\CommandBusInterface;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\Response;
use App\Users\Application\Command\Create\CreateUserCommand;
use App\Users\Application\DTO\UsersDTO;
use App\Users\Application\Query\GetByEmail\GetUserByEmailQuery;
use App\Users\Application\Query\Listing\SearchUsersQuery;

final class Api
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus
    ) {
    }

    public function create(string $login, string $email, string $password): void
    {
        $this->commandBus->dispatch(
            new CreateUserCommand(
                $login,
                $email,
                $password
            )
        );
    }

    public function getByEmail(string $email): Response
    {
        return $this->queryBus->ask(
            new GetUserByEmailQuery($email)
        );
    }

    public function search(
        ?array $filters,
        ?string $orderBy,
        ?string $order,
        ?int $limit,
        ?int $offset
    ): UsersDTO {
        /** @var UsersDTO $usersDto */
        $usersDto = $this->queryBus->ask(
            new SearchUsersQuery(
                $filters,
                $orderBy,
                $order,
                $limit,
                $offset
            )
        );

        return $usersDto;
    }
}
