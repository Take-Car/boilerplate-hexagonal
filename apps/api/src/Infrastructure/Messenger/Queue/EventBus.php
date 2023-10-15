<?php

namespace Infrastructure\Symfony\Messenger\Queue;

use Application\Queue\EventBusInterface;
use Symfony\Component\Messenger\MessageBus;

class EventBus implements EventBusInterface
{
    public function __construct(private readonly MessageBus $messageBus)
    {
    }

    public function dispatch(object $event): void
    {
        $this->messageBus->dispatch($event);
    }
}
