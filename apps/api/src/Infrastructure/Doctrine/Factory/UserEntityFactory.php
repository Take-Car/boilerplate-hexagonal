<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Factory;

use Domain\Factory\UserFactory;
use Domain\Model\User;
use Infrastructure\Doctrine\Entity\UserEntity;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

#[AsAlias]
final readonly class UserEntityFactory implements UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(string $username, string $password): User
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
