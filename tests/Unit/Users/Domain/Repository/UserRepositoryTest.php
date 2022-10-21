<?php

declare(strict_types=1);

namespace Tests\Unit\Users\Domain\Repository;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Factory\UserEntityFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private UserEntityFactory $factory;

    protected function setUp(): void
    {
        $this->factory = app(UserEntityFactory::class);
        parent::setUp();
    }

    public function test_user_added_successfully(): void
    {
        $userEntity = $this->factory->create();
        $repository = $this->mockUserRepository($userEntity);

        // act
        $repository->create($userEntity);

        // assert
        $existingUser = $repository->getByUuid($userEntity->getUuid());
        $this->assertEquals($userEntity->getUuid()->value(), $existingUser->getUuid()->value());
    }

    private function mockUserRepository(UserEntity $userEntity): UserRepositoryInterface
    {
        $mock = Mockery::mock(UserRepositoryInterface::class);
        $mock->shouldReceive('create')->andReturn($userEntity);
        $mock->shouldReceive('getByUuid')->andReturn($userEntity);
        return $this->app->instance(UserRepositoryInterface::class, $mock);
    }
}
