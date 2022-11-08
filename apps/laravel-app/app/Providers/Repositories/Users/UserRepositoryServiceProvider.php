<?php

declare(strict_types=1);

namespace Apps\LaravelApp\Providers\Repositories\Users;

use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Infrastructure\Persistence\Eloquent\Repository\DbUserRepository;
use Illuminate\Support\ServiceProvider;

class UserRepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, DbUserRepository::class);
    }
}
