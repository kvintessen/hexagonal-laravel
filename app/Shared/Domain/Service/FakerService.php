<?php

namespace App\Shared\Domain\Service;

use Illuminate\Support\Str;

final class FakerService
{
    /**
     * @uses uuid
     * @uses name
     * @uses safeEmail
     * @uses password
     */
    public static function generate(string $type): string
    {
        if (method_exists(__CLASS__, $type)) {
            return self::$type();
        }

        return Str::random();
    }

    private static function uuid(): string
    {
        return UuidService::generate();
    }

    private static function name(): string
    {
        return fake()->unique()->name();
    }

    private static function safeEmail(): string
    {
        return fake()->unique()->safeEmail();
    }

    private static function password(): string
    {
        return HashService::make(fake()->password());
    }
}
