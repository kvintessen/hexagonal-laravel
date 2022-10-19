<?php

namespace App\Users\Infrastructure\Adapters;

use App\ModuleX\Infrastructure\API\API;

class ModuleXAdapter
{
    public function __construct(
        private readonly API $moduleX
    ) {}

    public function getSomeData(): array
    {
        $data = $this->moduleX->getSomeData();

        //mapping

        return [];
    }
}
