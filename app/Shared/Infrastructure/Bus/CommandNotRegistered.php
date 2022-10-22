<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use Throwable;

class CommandNotRegistered extends InfrastructureException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "" === $message ? "Command not registered" : $message;
        parent::__construct($message, $code, $previous);
    }
}
