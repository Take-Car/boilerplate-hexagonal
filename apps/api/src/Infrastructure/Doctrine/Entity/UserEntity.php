<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Model\User;
use Infrastructure\Doctrine\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

class UserEntity extends User implements EntityInterface, UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(public readonly Uuid $uuid)
    {
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // Nothing to erase
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public static function loadMetadata(ClassMetadata $metadata): void
    {
        $builder = new ClassMetadataBuilder($metadata);

        $builder->setTable('user');
        $builder->setCustomRepositoryClass(UserRepository::class);

        $builder
            ->createField('uuid', UuidType::NAME)->makePrimaryKey()->build()
            ->createField('username', 'string')->length(64)->unique()->build()
            ->createField('password', 'string')->length(96)->nullable()->build()
        ;
    }
}
