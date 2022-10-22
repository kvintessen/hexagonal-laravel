<?php

declare(strict_types=1);

namespace Tests\Users\Infrastructure;

use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

abstract class UserModuleUnitTestCase extends UnitTestCase
{
    private $repository;
    private $repositoryProphecy;

    protected function shouldGetByUuid(UserEntityId $id, UserEntity $userEntity): void
    {
        $this->repositoryProphecy()->getByUuid($id)->willReturn($userEntity);
    }

    protected function shouldNotGetByUuid(UserEntityId $id): void
    {
        $this->repositoryProphecy()->getByUuid($id)->willReturn(null);
    }

    protected function shouldGetByEmail(UserEntityEmail $email, UserEntity $userEntity): void
    {
        $this->repositoryProphecy()->getByEmail($email)->willReturn($userEntity);
    }

    protected function shouldCreate(UserEntity $userEntity): void
    {
        $this->repositoryProphecy()->create($userEntity);
    }

    protected function shouldNotCreate(UserEntity $userEntity): void
    {
        $this->shouldGetByUuid(
            $userEntity->getUuid(),
            $userEntity
        );
    }

    protected function repository()
    {
        return $this->repository = $this->repository ?? $this->repositoryProphecy()->reveal();
    }

    private function repositoryProphecy()
    {
        return $this->repositoryProphecy = $this->repositoryProphecy ?? $this->prophecy(UserRepositoryInterface::class);
    }
}
