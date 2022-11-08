<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

use Faker\Factory;
use Illuminate\Support\Str;

final class FakerService
{
    /**
     * @uses uuid
     * @uses login
     * @uses email
     * @uses password
     */
    public static function generate(string $type = null): string
    {
        if ($type && method_exists(__CLASS__, $type)) {
            return self::$type();
        }

        return Str::random();
    }

    private static function uuid(): string
    {
        return Factory::create()->unique()->uuid();
    }

    private static function login(): string
    {
        return Factory::create()->unique()->firstName();
    }

    private static function email(): string
    {
        return Factory::create()->unique()->safeEmail();
    }

    private static function password(): string
    {
        return Factory::create()->password();
    }
}
