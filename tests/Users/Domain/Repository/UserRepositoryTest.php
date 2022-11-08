<?php

declare(strict_types=1);

namespace Tests\Users\Domain\Repository;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Repository\UserRepositoryInterface;
use DG\BypassFinals;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tests\Users\Domain\Entity\UserEntityMother;

class UserRepositoryTest extends TestCase
{
    public function setUp(): void
    {
        BypassFinals::setWhitelist([
            '*/src/*',
        ]);
        BypassFinals::setCacheDirectory(__DIR__ . '/../../../../.cache');
        BypassFinals::enable();
        parent::setUp();
    }

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

    private function mockUserRepository(UserEntity $userEntity): UserRepositoryInterface|MockObject
    {
        $repository = $this->createMock(UserRepositoryInterface::class);

        $repository->expects($this->once())
            ->method('create')
            ->with($userEntity);

        $repository->expects($this->once())
            ->method('getByUuid')
            ->with($userEntity->getUuid())
            ->willReturn($userEntity);

        return $repository;
    }
}
