<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * @phpstan-template EntityClass of object
 */
abstract readonly class AbstractRepository
{
    /**
     * @param class-string<EntityClass> $entityClass
     */
    public function __construct(
        private EntityManagerInterface $entityManager,
        private string $entityClass,
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

    /**
     * @return EntityRepository<EntityClass>
     */
    protected function getRepository(): EntityRepository
    {
        /**
         * @var EntityRepository<EntityClass>
         */
        return $this->entityManager->getRepository($this->entityClass);
    }

    protected function createQueryBuilder(): QueryBuilder
    {
        $shortName = (new \ReflectionClass($this->entityClass))->getName();

        return $this->getRepository()
            ->createQueryBuilder($shortName)
        ;
    }
}
