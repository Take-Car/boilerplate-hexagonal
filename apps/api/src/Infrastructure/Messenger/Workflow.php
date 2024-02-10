<?php

declare(strict_types=1);

namespace Infrastructure\Messenger;

use Application\Messenger\BusInterface;
use Application\Messenger\WorkflowInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

#[AsAlias]
class Workflow implements WorkflowInterface
{
    public function __construct(
        private readonly BusInterface $bus,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[\Override]
    public function run(\Closure $task): mixed
    {
        $this->entityManager->beginTransaction();

        try {
            $output = $task($this->bus);
        } catch (\Throwable $e) {
            $this->entityManager->rollback();

            throw $e;
        }

        $this->entityManager->flush();
        $this->entityManager->commit();

        return $output;
    }
}
