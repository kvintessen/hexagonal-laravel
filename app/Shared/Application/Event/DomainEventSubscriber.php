<?php

declare(strict_types=1);

namespace App\Shared\Application\Event;

interface DomainEventSubscriber
{
    public static function subscribedTo(): array;
}
