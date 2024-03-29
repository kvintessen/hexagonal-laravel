<?php

declare(strict_types=1);

namespace App\Users\Application\Command\Create;

use App\Shared\Domain\Bus\Command\CommandInterface;

final class CreateUserCommand implements CommandInterface
{
    public function __construct(
        public readonly string $login,
        public readonly string $email,
        public readonly string $password
    ) {
    }
}
