<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Model;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

/**
 * TODO: remove this file after forking the project.
 */
class Movie extends Model\Movie
{
    private Uuid $uuid;

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * @param ClassMetadata<self> $metadata
     */
    public static function loadMetadata(ClassMetadata $metadata): void
    {
        $builder = new ClassMetadataBuilder($metadata);

        $builder->setTable('movies');

        $builder->createField('uuid', UuidType::NAME)
            ->makePrimaryKey()
            ->generatedValue('CUSTOM')
            ->setCustomIdGenerator('doctrine.uuid_generator')
            ->build();

        $builder->createField('title', 'string')
            ->length(255)
            ->nullable(false)
            ->build();

        $builder->createField('description', 'text')
            ->nullable(false)
            ->nullable(false)
            ->build();

        $builder->createField('releaseDate', 'datetime_immutable')
            ->build();
    }
}
