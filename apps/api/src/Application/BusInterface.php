<?php

namespace Application;

use Domain\Command\CommandInterface;
use Domain\Event\EventInterface;
use Domain\Query\QueryInterface;

interface BusInterface
{
    public function ask(QueryInterface $query): mixed;

    public function dispatch(CommandInterface $command): void;

    public function emit(EventInterface $event): void;
}
