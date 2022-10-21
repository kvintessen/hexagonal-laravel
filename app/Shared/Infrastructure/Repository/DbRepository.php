<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class DbRepository
{
    public function __construct(
        protected Model|Builder $model,
    ) {}

    public function getById(int $id): Model
    {
        return $this->model->find($id);
    }

}
