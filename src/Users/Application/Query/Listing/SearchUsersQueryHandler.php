<?php

declare(strict_types=1);

namespace App\Users\Application\Query\Listing;

use App\Shared\Domain\Bus\Query\QueryHandlerInterface;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\Criteria\Order;
use App\Shared\Domain\Criteria\OrderType;
use App\Users\Application\DTO\UsersDTO;
use App\Users\Domain\Repository\UserRepositoryInterface;

final class SearchUsersQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    public function __invoke(SearchUsersQuery $query): UsersDTO
    {
        $criteria = new Criteria(
            new Filters($query->filters()),
            new Order($query->orderBy(), OrderType::type($query->order())),
            $query->offset(),
            $query->limit()
        );

        $users = $this->repository->search($criteria);

        return UsersDTO::fromUsers($users);
    }
}
