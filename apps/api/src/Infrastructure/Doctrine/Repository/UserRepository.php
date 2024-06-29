<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Domain;
use Infrastructure\Doctrine\Entity\UserEntity;

/**
 * @extends AbstractRepository<Domain\Model\User>
 */
final class UserRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEntity::class);
    }
}
