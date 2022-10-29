<?php

namespace App\Shared\Infrastructure\Facade;

use App\Shared\Infrastructure\Service\FakerService;

class FakerServiceFacade
{
    public static function generate(string $type): string
    {
        return (new FakerService())->generate($type);
    }
}
