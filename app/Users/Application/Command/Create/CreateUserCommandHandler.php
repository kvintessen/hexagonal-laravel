<?php

declare(strict_types=1);

namespace App\Users\Application\Command\Create;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Service\UuidServiceInterface;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Factory\UserEntityFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;

final class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserEntityFactory $userEntityFactory,
        private readonly UuidServiceInterface $uuidService
    ) {
    }

    public function __invoke(CreateUserCommand $command): UserEntityId
    {
        $userEntity = $this->userEntityFactory->create(
            $this->uuidService->generate(),
            $command->login,
            $command->email,
            $command->password
        );
        $this->userRepository->create($userEntity);

        return $userEntity->getUuid();
    }
}
