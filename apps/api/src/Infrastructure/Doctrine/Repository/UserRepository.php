<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Infrastructure\Doctrine\Entity\User;

/**
 * @extends AbstractRepository<User>
 */
final class UserRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function exists(string $email): bool
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getSingleScalarResult() > 0;
    }
}
