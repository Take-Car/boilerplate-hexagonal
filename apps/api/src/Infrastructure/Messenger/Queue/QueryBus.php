<?php

namespace Infrastructure\Symfony\Messenger\Queue;

use Domain\Query\QueryInterface;
use Domain\Queue\QueryBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(private readonly MessageBusInterface $messageBus)
    {
    }

    public function ask(QueryInterface $query): mixed
    {
        try {
            return $this->handle($query);
        } catch (HandlerFailedException $handlerFailedException) {
            throw $handlerFailedException->getPrevious() ?: $handlerFailedException;
        }
    }
}
