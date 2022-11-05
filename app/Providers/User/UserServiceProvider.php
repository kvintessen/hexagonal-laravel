<?php

namespace App\Providers\User;

use App\Users\Application\Command\Create\CreateUserCommandHandler;
use App\Users\Application\Query\GetByEmail\GetUserByEmailQueryHandler;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Infrastructure\Persistence\Eloquent\Repository\DbUserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public const QUERY_HANDLER_TAG = 'query_handler';
    public const COMMAND_HANDLER_TAG = 'command_handler';
    public const EVENT_HANDLER_TAG = 'domain_event_subscriber';

    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            DbUserRepository::class
        );

        $this->app->tag(
            CreateUserCommandHandler::class,
            self::COMMAND_HANDLER_TAG
        );

        $this->app->tag(
            GetUserByEmailQueryHandler::class,
            self::QUERY_HANDLER_TAG
        );
    }
}
