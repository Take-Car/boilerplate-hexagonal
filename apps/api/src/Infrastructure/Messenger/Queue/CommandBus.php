<?php

namespace Infrastructure\Symfony\Messenger\Queue;

use Application\Queue\CommandBusInterface;
use Domain\Command\CommandInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBus;

class CommandBus implements CommandBusInterface
{
    use HandleTrait;

    public function __construct(private readonly MessageBus $messageBus)
    {
    }

    public function dispatch(CommandInterface $command): void
    {
        try {
            $this->handle($command);
        } catch (HandlerFailedException $exception) {
            throw $exception->getPrevious() ?: $exception;
        }
    }
}
