<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @phpstan-template EntityClass of object
 *
 * @phpstan-extends ServiceEntityRepository<EntityClass>
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @phpstan-param class-string<EntityClass> $entityClass
     */
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    /**
     * @phpstan-param EntityClass $entity
     */
    public function add(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
    }

    /**
     * @phpstan-param EntityClass $entity
     */
    public function remove(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
    }
}
