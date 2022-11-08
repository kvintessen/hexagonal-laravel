<?php

declare(strict_types=1);

namespace Apps\LaravelApp\Providers;

use App\Shared\Domain\Bus\Command\CommandBusInterface;
use App\Shared\Domain\Bus\Event\EventBusInterface;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Infrastructure\Bus\Messenger\MessengerCommandBus;
use App\Shared\Infrastructure\Bus\Messenger\MessengerEventBus;
use App\Shared\Infrastructure\Bus\Messenger\MessengerQueryBus;
use App\Users\Application\Subscriber\SomethingWithCreatedUserSubscriber;
use Apps\LaravelApp\Providers\User\UserServiceProvider;
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
            EventBusInterface::class,
            function ($app)
            {
                return new MessengerEventBus($app->tagged(UserServiceProvider::EVENT_HANDLER_TAG));
            }
        );

        $this->app->tag(
            SomethingWithCreatedUserSubscriber::class,
            UserServiceProvider::EVENT_HANDLER_TAG
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
