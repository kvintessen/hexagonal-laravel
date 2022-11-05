<?php

declare(strict_types=1);

namespace App\Users\Domain\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;

class UserWasCreated extends DomainEvent
{
    public function __construct(
        private readonly string $uuid,
        private readonly string $login,
        private readonly string $email,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($uuid, $eventId, $occurredOn);
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self($aggregateId, $body['login'], $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'user.was_created';
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->uuid,
            'name' => $this->login,
        ];
    }

    public function id(): string
    {
        return $this->uuid;
    }

    public function login(): string
    {
        return $this->login;
    }

    public function email(): string
    {
        return $this->email;
    }
}
