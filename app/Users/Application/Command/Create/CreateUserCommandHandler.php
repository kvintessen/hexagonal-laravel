<?php

declare(strict_types=1);

namespace App\Users\Application\Command\Create;

use App\Shared\Domain\Command\CommandHandlerInterface;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Factory\UserEntityFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;

final class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function __invoke(CreateUserCommand $command): UserEntityId
    {
        $userEntity = (new UserEntityFactory())->create();
        $this->userRepository->create($userEntity);

        return $userEntity->getUuid();
    }
}
