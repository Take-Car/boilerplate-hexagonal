<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Factory;

use Application;
use Domain;
use Infrastructure\Doctrine\Entity\UserEntity;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[AsAlias(Application\Factory\UserFactory::class)]
#[AsAlias(Domain\Factory\UserFactory::class)]
final readonly class UserEntityFactory implements Application\Factory\UserFactory, Domain\Factory\UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(string $username, string $password): Domain\Model\User&UserInterface
    {
        if ('' === $username) {
            throw new \InvalidArgumentException('The username must not be empty');
        }

        $user = new UserEntity(Uuid::v7());
        $user->username = $username;

        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);

        if ('' === $hashedPassword) {
            throw new \InvalidArgumentException('The password must not be empty');
        }

        $user->password = $hashedPassword;

        return $user;
    }
}
