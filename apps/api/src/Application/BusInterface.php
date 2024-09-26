<?php

namespace Application;

use Domain\Message\CommandInterface;
use Domain\Message\EventInterface;
use Domain\Message\QueryInterface;

interface BusInterface
{
    public function ask(QueryInterface $query): mixed;

    public function dispatch(CommandInterface $command): void;

    public function emit(EventInterface $event): void;
}
