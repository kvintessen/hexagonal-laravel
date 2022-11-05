<?php

declare(strict_types=1);

namespace App\Users\Application\Command\Create;

use App\Shared\Domain\Bus\Command\CommandHandlerInterface;
use App\Shared\Domain\Bus\Event\EventBusInterface;
use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Entity\UserEntityLogin;
use App\Users\Domain\Entity\UserEntityPassword;
use App\Users\Domain\Repository\UserRepositoryInterface;

final class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly EventBusInterface $eventBus,
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $id = UserEntityId::random();
        $login = UserEntityLogin::fromValue($command->login);
        $email = UserEntityEmail::fromValue($command->email);
        $password = UserEntityPassword::fromValue($command->password);

        $user = UserEntity::create($id, $login, $email, $password);
        $this->userRepository->create($user);
        $this->eventBus->publish(...$user->pullDomainEvents());
    }
}
