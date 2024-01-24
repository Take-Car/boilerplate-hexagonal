<?php

namespace Infrastructure\Messenger;

use Domain\BusInterface;
use Domain\Command\CommandInterface;
use Domain\Event\EventInterface;
use Domain\Query\QueryInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class Bus implements BusInterface
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private MessageBusInterface $queryBus,
        private MessageBusInterface $eventBus
    ) {
    }

    #[\Override]
    public function ask(QueryInterface $query): mixed
    {
        $envelope = $this->queryBus->dispatch($query);
        $handledStamp = $this->assertSingleHandler($envelope);

        return $handledStamp->getResult();
    }

    #[\Override]
    public function dispatch(CommandInterface $command): void
    {
        $envelope = $this->commandBus->dispatch($command);
        $this->assertSingleHandler($envelope);
    }

    #[\Override]
    public function emit(EventInterface $event): void
    {
        $this->eventBus->dispatch($event);
    }

    private function assertSingleHandler(Envelope $envelope): HandledStamp
    {
        /** @var HandledStamp[] $handledStamps */
        $handledStamps = $envelope->all(HandledStamp::class);

        if (!$handledStamps) {
            $className = get_class($envelope->getMessage());
            throw new \LogicException("Message {$className} was not handled. Did you forget to add a handler for it?");
        }

        if (\count($handledStamps) > 1) {
            $className = get_class($envelope->getMessage());
            $handlers = implode(', ', array_map(fn (HandledStamp $stamp): string => sprintf('"%s"', $stamp->getHandlerName()), $handledStamps));

            throw new \LogicException("Message {$className} was handled by multiple handlers: {$handlers}. Only one handler per message is supported.");
        }

        return $handledStamps[0];
    }
}
