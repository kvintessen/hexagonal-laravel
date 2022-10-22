<?php

declare(strict_types=1);

namespace Tests\Users\Application\Query\GetByEmail;

use App\Users\Application\DTO\UserDTO;
use App\Users\Application\Query\GetByEmail\GetUserByEmailQueryHandler;
use Tests\Users\Domain\Entity\UserEntityMother;
use Tests\Users\Infrastructure\UserModuleUnitTestCase;

class GetUserByEmailQueryHandlerTest extends UserModuleUnitTestCase
{
    private GetUserByEmailQueryHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new GetUserByEmailQueryHandler(
            $this->repository()
        );
    }

    public function test_it_should_get_a_user_by_email(): void
    {
        $userEntity = UserEntityMother::create();
        $query = GetUserByEmailQueryMother::create($userEntity->getEmail());
        $response = UserDTO::fromEntity($userEntity);
        $this->shouldGetByEmail($userEntity->getEmail(), $userEntity);

        $this->assertAskResponse($response, $query, $this->handler);
    }
}
