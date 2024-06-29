<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Collection;

use Domain;
use Infrastructure\Doctrine\Entity\UserEntity;
use Infrastructure\Doctrine\Repository\UserRepository;
use Psr\Clock\ClockInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class UserCollection implements Domain\Collection\UserCollection
{
    public function __construct(
        private ClockInterface $clock,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function create(string $email, string $password): Domain\Model\User
    {
        $user = new UserEntity($email, $this->clock);
        $user->setHashedPassword($this->passwordHasher->hashPassword($user, $password));

        return $user;
    }

    public function add(Domain\Model\User $user): void
    {
        $this->userRepository->add($user);
    }

    public function remove(Domain\Model\User $user): void
    {
        $this->userRepository->remove($user);
    }

    public function get(string $id): Domain\Model\User
    {
        $user = $this->userRepository->find($id);

        if (!$user instanceof Domain\Model\User) {
            throw Domain\Exception\UserNotFoundException::withId($id);
        }

        return $user;
    }

    public function findByEmail(string $email): ?Domain\Model\User
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }
}
