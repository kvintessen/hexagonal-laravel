<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use Throwable;

final class CommandNotRegistered extends InfrastructureException
{
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        $message = '' === $message ? 'Command not registered' : $message;
        parent::__construct($message, $code, $previous);
    }
}
