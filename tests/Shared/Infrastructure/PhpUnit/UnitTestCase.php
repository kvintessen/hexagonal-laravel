<?php

declare(strict_types=1);

namespace Tests\Shared\Infrastructure\PhpUnit;

use App\Shared\Domain\Bus\Command\CommandBusInterface;
use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Shared\Domain\Bus\Event\EventBusInterface;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\QueryInterface;
use App\Users\Application\DTO\UserDTO;
use DG\BypassFinals;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;
use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase
{
    protected Prophet $prophet;
    private $queryBus;
    private $queryBusProphecy;
    private $commandBus;
    private $commandBusProphecy;
    private $eventBus;
    private $eventBusProphecy;

    protected function setUp(): void
    {
        BypassFinals::setWhitelist([
            '*/src/*',
        ]);
        BypassFinals::setCacheDirectory(__DIR__ . '/../../../../.cache');
        BypassFinals::enable();
        parent::setUp();
        $this->prophet = new Prophet();
    }

    protected function tearDown(): void
    {
//        $this->prophet->checkPredictions();
    }

    protected function prophecy(string $interface): ObjectProphecy
    {
        return $this->prophet->prophesize($interface);
    }

    protected function assertOk(): void
    {
        $this->assertTrue(true);
    }

    protected function dispatch(CommandInterface $command, callable $commandHandler): void
    {
        $commandHandler($command);
    }

    protected function assertAskResponse(UserDTO $expected, QueryInterface $query, callable $queryHandler): void
    {
        $actual = $queryHandler($query);

        $this->assertEquals($expected, $actual);
    }

    protected function queryBus(): object
    {
        return $this->queryBus = $this->queryBus
            ?? $this->queryBusProphecy()->reveal();
    }

    protected function queryBusProphecy(): ObjectProphecy
    {
        return $this->queryBusProphecy = $this->queryBusProphecy
            ?? $this->prophecy(QueryBusInterface::class);
    }

    protected function commandBus(): object
    {
        return $this->commandBus = $this->commandBus
            ?? $this->commandBusProphecy()->reveal();
    }

    protected function commandBusProphecy(): ObjectProphecy
    {
        return $this->commandBusProphecy = $this->commandBusProphecy
            ?? $this->prophecy(CommandBusInterface::class);
    }

    protected function eventBus()
    {
        return $this->eventBus = $this->eventBus ?? $this->eventBusProphecy()->reveal();
    }

    protected function eventBusProphecy()
    {
        return $this->eventBusProphecy = $this->eventBusProphecy ?? $this->prophecy(EventBusInterface::class);
    }
}
