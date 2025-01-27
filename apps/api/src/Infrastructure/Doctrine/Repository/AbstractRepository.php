<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @template EntityClass of object
 *
 * @extends ServiceEntityRepository<EntityClass>
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @param class-string<EntityClass> $entityClass
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ManagerRegistry $managerRegistry,
        string $entityClass,
    ) {
        parent::__construct($managerRegistry, $entityClass);
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder($this->getDefaultAlias());
    }

    abstract public function getDefaultAlias(): string;
}
