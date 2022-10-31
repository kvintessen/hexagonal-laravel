<?php

declare(strict_types=1);

namespace App\Providers;

use App\Providers\User\UserServiceProvider;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\Service\FakerServiceInterface;
use App\Shared\Domain\Service\HashServiceInterface;
use App\Shared\Domain\Service\UuidServiceInterface;
use App\Shared\Infrastructure\Bus\Messenger\MessengerCommandBus;
use App\Shared\Infrastructure\Bus\Messenger\MessengerQueryBus;
use App\Shared\Infrastructure\Service\FakerService;
use App\Shared\Infrastructure\Service\HashService;
use App\Shared\Infrastructure\Service\UuidService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            QueryBusInterface::class,
            function ($app)
            {
                return new MessengerQueryBus($app->tagged(UserServiceProvider::QUERY_HANDLER_TAG));
            }
        );

        $this->app->bind(
            CommandBusInterface::class,
            function ($app)
            {
                return new MessengerCommandBus($app->tagged(UserServiceProvider::COMMAND_HANDLER_TAG));
            }
        );

        $this->app->bind(
            UuidServiceInterface::class,
            UuidService::class
        );

        $this->app->bind(
            HashServiceInterface::class,
            HashService::class
        );

        $this->app->bind(
            FakerServiceInterface::class,
            FakerService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $mainPath = base_path(config('database.migrations_path'));

        $this->loadMigrationsFrom($mainPath);
    }
}
