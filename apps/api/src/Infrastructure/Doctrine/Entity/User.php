<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain;
use Infrastructure\Doctrine\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

class User extends Domain\Model\User implements EntityInterface, UserInterface, PasswordAuthenticatedUserInterface
{
    private Uuid $id;

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }

    public function getPassword(): ?string
    {
        return $this->getHashedPassword();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public static function loadMetadata(ClassMetadata $cm): void
    {
        $builder = new ClassMetadataBuilder($cm);

        $builder->setTable('users')
            ->setCustomRepositoryClass(UserRepository::class);

        $builder->createField('id', UuidType::NAME)
            ->makePrimaryKey()
            ->generatedValue('CUSTOM')
            ->setCustomIdGenerator('doctrine.uuid_generator')
            ->build();

        $builder->createField('email', 'string')
            ->length(255)
            ->unique()
            ->build();

        $builder->createField('hashedPassword', 'string')
            ->length(255)
            ->build();
    }
}
