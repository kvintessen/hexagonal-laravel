<?php

declare(strict_types=1);

namespace Tests\Users\Application\Command\Create;

use App\Shared\Domain\Service\UuidService;
use App\Users\Application\Command\Create\CreateUserCommandHandler;
use App\Users\Domain\Factory\UserEntityFactory;
use Tests\Users\Domain\Entity\UserEntityMother;
use Tests\Users\Infrastructure\UserModuleUnitTestCase;

class CreateUserCommandHandlerTest extends UserModuleUnitTestCase
{
    private CreateUserCommandHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = new CreateUserCommandHandler(
            $this->repository(),
            new UserEntityFactory(),
            new UuidService()
        );
    }

    public function test_it_should_create_a_user(): void
    {
        $userEntity = UserEntityMother::create();
        $command = CreateUserCommandMother::create(
            $userEntity->getLogin(),
            $userEntity->getEmail(),
            $userEntity->getPassword()
        );

        $this->shouldNotGetByUuid($userEntity->getUuid());
        $this->shouldCreate($userEntity);
        $this->dispatch($command, $this->handler);
        $this->assertOk();
    }
}
