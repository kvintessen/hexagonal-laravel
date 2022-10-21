<?php

declare(strict_types=1);

namespace App\Users\Domain\Factory;

use App\Shared\Domain\Service\HashService;
use App\Users\Domain\Entity\UserEntity;
use App\Users\Domain\Entity\UserEntityEmail;
use App\Users\Domain\Entity\UserEntityId;
use App\Users\Domain\Entity\UserEntityLogin;
use App\Users\Domain\Entity\UserEntityPassword;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Support\Carbon;

class UserEntityFactory
{
    #[ArrayShape([
        'uuid'              => UserEntityId::class,
        'login'             => UserEntityLogin::class,
        'email'             => UserEntityEmail::class,
        'email_verified_at' => Carbon::class,
        'password'          => UserEntityPassword::class,
        'remember_token'    => "string"
    ])]
    public function create(): UserEntity
    {
        return new UserEntity(
            UserEntityId::fromValue(fake()->uuid()),
            UserEntityLogin::fromValue(fake()->unique()->name()),
            UserEntityEmail::fromValue(fake()->unique()->safeEmail()),
            UserEntityPassword::fromValue(HashService::make(fake()->password())),
        );
    }
}
