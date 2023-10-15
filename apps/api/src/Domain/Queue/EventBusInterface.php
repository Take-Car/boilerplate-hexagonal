<?php

namespace Application\Queue;

use Domain\Event\EventInterface;

interface EventBusInterface
{
    public function dispatch(EventInterface $event): void;
}
