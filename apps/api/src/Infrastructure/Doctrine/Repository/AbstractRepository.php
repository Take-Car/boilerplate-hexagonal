<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @phpstan-template EntityClass of object
 */
abstract class AbstractRepository
{
    /**
     * @var EntityRepository<EntityClass>
     */
    protected EntityRepository $repository;

    /**
     * @param class-string $entityClass
     */
    public function __construct(
        private EntityManager $entityManager,
        string $entityClass
    )
    {
        $this->repository = $this->entityManager->getRepository($entityClass);
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
