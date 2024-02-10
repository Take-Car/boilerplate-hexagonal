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
    ) {}

    /**
     * @inheritdoc
     */
    public function handle(\Closure $task): mixed
    {
        $this->entityManager->beginTransaction();

        try {
            $task($this->bus);
        } catch (\Throwable $e) {
            $this->entityManager->rollback();
        }

        $this->entityManager->flush();
        $this->entityManager->commit();
    }

}
