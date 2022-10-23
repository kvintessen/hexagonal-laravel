<?php

declare(strict_types=1);

namespace App\Users\Domain\Factory;

use App\Shared\Domain\Service\FakerService;
use App\Users\Domain\Entity\UserEntity;
use JetBrains\PhpStorm\ArrayShape;

final class UserEntityFactory
{
    #[ArrayShape([
        'uuid'     => "string",
        'login'    => "string",
        'email'    => "string",
        'password' => "string",
    ])]
    public function create(): UserEntity
    {
        return UserEntity::fromPrimitives(
            FakerService::generate('uuid'),
            FakerService::generate('login'),
            FakerService::generate('email'),
            FakerService::generate('password'),
        );
    }
}
