<?php

declare(strict_types=1);

namespace App\Users\Domain\Service;

interface FakerServiceInterface
{
    public function generate(string $type = null): string;

    public function uuid(): string;

    public function login(): string;

    public function email(): string;

    public function password(): string;
}
