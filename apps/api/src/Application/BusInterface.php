<?php

namespace Application;

use Domain\Message\Command\CommandInterface;
use Domain\Message\Event\EventInterface;
use Domain\Message\Query\QueryInterface;

interface BusInterface
{
    public function ask(QueryInterface $query): mixed;

    public function dispatch(CommandInterface $command): void;

    public function emit(EventInterface $event): void;
}
