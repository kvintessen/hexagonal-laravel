<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Messenger;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Command\CommandInterface;
use App\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use App\Shared\Infrastructure\Bus\CommandNotRegistered;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;
use Throwable;

final class MessengerCommandBus implements CommandBusInterface
{
    private MessageBus $bus;

    public function __construct(iterable $commandHandlers)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator(CallableFirstParameterExtractor::forCallables($commandHandlers))
            ),
        ]);
    }

    /**
     * @throws Throwable
     */
    public function dispatch(CommandInterface $command): void
    {
        try {
            $this->bus->dispatch($command)->with(new DispatchAfterCurrentBusStamp());
        } catch (NoHandlerForMessageException) {
            throw new CommandNotRegistered('Command ' . get_class($command) . ' not registered.');
        } catch (HandlerFailedException $error) {
            throw $error->getPrevious() ?? $error;
        }
    }
}
