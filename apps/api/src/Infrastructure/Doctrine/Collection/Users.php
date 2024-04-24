<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Collection;

use Domain;
use Infrastructure\Doctrine\Entity\User;
use Infrastructure\Doctrine\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class Users implements Domain\Collection\UsersInterface
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function create(string $email, string $plainPassword): Domain\Model\User
    {
        $user = new User($email);
        $user->setHashedPassword($this->passwordHasher->hashPassword($user, $plainPassword));

        return $user;
    }

    public function add(Domain\Model\User $user): void
    {
        if (!$user instanceof User) {
            throw new \RuntimeException('User must be an instance of '.User::class);
        }

        $this->repository->add($user);
    }

    public function remove(Domain\Model\User $user): void
    {
        if (!$user instanceof User) {
            throw new \RuntimeException('User must be an instance of '.User::class);
        }

        $this->repository->remove($user);
    }

    public function get(string $email): ?Domain\Model\User
    {
        return $this->repository->findOneBy(['email' => $email]);
    }

    public function exists(string $email): bool
    {
        return $this->repository->exists($email);
    }
}
