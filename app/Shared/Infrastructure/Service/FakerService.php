<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Service;

use App\Shared\Domain\Service\FakerServiceInterface;
use Illuminate\Support\Str;

final class FakerService implements FakerServiceInterface
{
    /**
     * @uses uuid
     * @uses login
     * @uses email
     * @uses password
     */
    public function generate(string $type = null): string
    {
        if ($type && method_exists(__CLASS__, $type)) {
            return $this->$type();
        }

        return Str::random();
    }

    public function uuid(): string
    {
        return fake()->unique()->uuid();
    }

    public function login(): string
    {
        return fake()->unique()->firstName();
    }

    public function email(): string
    {
        return fake()->unique()->safeEmail();
    }

    public function password(): string
    {
        return fake()->password();
    }
}
