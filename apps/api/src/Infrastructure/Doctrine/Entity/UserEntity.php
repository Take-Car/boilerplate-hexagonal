<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Model\User;
use Infrastructure\Doctrine\Repository\UserRepository;
use Psr\Clock\ClockInterface;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

class UserEntity extends User implements EntityInterface, UserInterface, PasswordAuthenticatedUserInterface
{
    public readonly Uuid $id;
    public readonly \DateTimeImmutable $createdAt;

    public function __construct(
        string $email,
        ClockInterface $clock
    ) {
        parent::__construct($email);

        $this->id = Uuid::v4();
        $this->createdAt = $clock->now();
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // No sensitive data to erase
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }

    public function getPassword(): ?string
    {
        return $this->getHashedPassword();
    }

    public static function loadMetadata(ClassMetadata $metadata): void
    {
        $builder = new ClassMetadataBuilder($metadata);

        $builder->setCustomRepositoryClass(UserRepository::class);

        $builder->createField('id', UuidType::NAME)
            ->makePrimaryKey()
            ->build();

        $builder->createField('email', 'string')
            ->unique()
            ->build();

        $builder->createField('hashedPassword', 'string')
            ->build();

        $builder->createField('createdAt', 'datetime_immutable')
            ->build();
    }
}
