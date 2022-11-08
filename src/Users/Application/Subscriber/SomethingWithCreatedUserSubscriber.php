<?php

namespace App\Users\Application\Subscriber;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Users\Domain\Event\UserWasCreated;

class SomethingWithCreatedUserSubscriber implements DomainEventSubscriber
{
    public function __invoke(UserWasCreated $event): void
    {
        // TODO add here some logic
    }

    public static function subscribedTo(): array
    {
        return [
            UserWasCreated::class,
        ];
    }
}
