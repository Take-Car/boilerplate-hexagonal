<?php

namespace Infrastructure\Messenger;

use Domain\Queue\BusInterface;
use Domain\Queue\Command\CommandInterface;
use Domain\Queue\Event\EventInterface;
use Domain\Queue\Query\QueryInterface;
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

    public function dispatch(CommandInterface|EventInterface $command): void
    {
        $bus = match (true) {
            $command instanceof CommandInterface => $this->commandBus,
            $command instanceof EventInterface => $this->eventBus
        };

        $envelope = $bus->dispatch($command);
        $this->assertSingleHandler($envelope);
    }

    public function ask(QueryInterface $query): mixed
    {
        $envelope = $this->queryBus->dispatch($query);
        $handledStamp = $this->assertSingleHandler($envelope);

        return $handledStamp->getResult();
    }

    private function assertSingleHandler(Envelope $envelope): HandledStamp
    {
        /** @var HandledStamp[] $handledStamps */
        $handledStamps = $envelope->all(HandledStamp::class);

        if (!$handledStamps) {
            throw new \LogicException(sprintf('Message of type "%s" was handled zero times. Exactly one handler is expected when using "%s::%s()".', get_debug_type($envelope->getMessage()), static::class, __FUNCTION__));
        }

        if (\count($handledStamps) > 1) {
            $handlers = implode(', ', array_map(fn (HandledStamp $stamp): string => sprintf('"%s"', $stamp->getHandlerName()), $handledStamps));

            throw new \LogicException(sprintf('Message of type "%s" was handled multiple times. Only one handler is expected when using "%s::%s()", got %d: %s.', get_debug_type($envelope->getMessage()), static::class, __FUNCTION__, \count($handledStamps), $handlers));
        }

        return $handledStamps[0];
    }
}
