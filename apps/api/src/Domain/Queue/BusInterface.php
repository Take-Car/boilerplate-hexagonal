<?php

namespace Domain\Queue;

use Domain\Queue\Command\CommandInterface;
use Domain\Queue\Event\EventInterface;
use Domain\Queue\Query\QueryInterface;

interface BusInterface
{
    public function dispatch(CommandInterface|EventInterface $command): void;

    public function ask(QueryInterface $query): mixed;
}
