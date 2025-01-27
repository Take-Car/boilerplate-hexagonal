<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Collection;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Collection\CollectionInterface;

abstract readonly class AbstractCollection implements CollectionInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function add(object $entity): void
    {
        $this->entityManager->persist($entity);
    }

    public function remove(object $entity): void
    {
        $this->entityManager->remove($entity);
    }
}
