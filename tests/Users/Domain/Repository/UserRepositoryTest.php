<?php

declare(strict_types=1);

namespace Tests\Users\Domain\Repository;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;
use Tests\Users\Domain\Entity\UserEntityMother;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_added_successfully(): void
    {
        $userEntity = UserEntityMother::create();
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
