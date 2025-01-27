<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Model\User;
use Infrastructure\Doctrine\Entity\UserEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends AbstractRepository<UserEntity>
 */
final class UserRepository extends AbstractRepository implements PasswordUpgraderInterface
{
    public function __construct(
        EntityManagerInterface $entityManager,
        ManagerRegistry $managerRegistry
    )
    {
        parent::__construct($entityManager, $managerRegistry, UserEntity::class);
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new \RuntimeException('Unknown object, expect Domain\\Model\\User got '.get_class($user));
        }

        if ('' === $newHashedPassword) {
            throw new \RuntimeException('The username must not be empty');
        }

        $user->password = $newHashedPassword;
    }

    public function getDefaultAlias(): string
    {
        return 'user';
    }
}
