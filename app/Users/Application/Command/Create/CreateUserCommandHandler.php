<?php

declare(strict_types=1);

namespace App\Users\Application\Command\Create;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Service\UuidService;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Factory\UserEntityFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;

final class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserEntityFactory $userEntityFactory,
    ) {
    }

    public function __invoke(CreateUserCommand $command): UserEntityId
    {
        $userEntity = $this->userEntityFactory->create(
            UuidService::generate(),
            $command->login,
            $command->email,
            $command->password
        );
        $this->userRepository->create($userEntity);

        return $userEntity->getUuid();
    }
}
