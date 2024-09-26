<?php

namespace Infrastructure\Symfony\Messenger;

use Application\BusInterface;
use Domain\Message\CommandInterface;
use Domain\Message\EventInterface;
use Domain\Message\QueryInterface;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

#[AsAlias]
final readonly class Bus implements BusInterface
{
    public function __construct(
        private MessageBusInterface $transactionalBus,
        private MessageBusInterface $simpleBus,
    ) {
    }

    #[\Override]
    public function ask(QueryInterface $query): mixed
    {
        $envelope = $this->simpleBus->dispatch($query);
        $handledStamp = $this->assertSingleHandler($envelope);

        return $handledStamp->getResult();
    }

    #[\Override]
    public function dispatch(CommandInterface $command): void
    {
        $envelope = $this->transactionalBus->dispatch($command);
        $this->assertSingleHandler($envelope);
    }

    #[\Override]
    public function emit(EventInterface $event): void
    {
        $this->simpleBus->dispatch($event);
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
