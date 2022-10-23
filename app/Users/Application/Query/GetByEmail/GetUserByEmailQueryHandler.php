<?php

declare(strict_types=1);

namespace App\Users\Application\Query\GetByEmail;

use App\Shared\Domain\Query\QueryHandlerInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Repository\UserRepositoryInterface;

final class GetUserByEmailQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {}

    public function __invoke(GetUserByEmailQuery $query): ?UserDTO
    {
        $email = UserEntityEmail::fromValue($query->email);
        $user = $this->userRepository->getByEmail($email);

        if (!$user) {
            return null;
        }

        return UserDTO::fromEntity($user);
    }
}
