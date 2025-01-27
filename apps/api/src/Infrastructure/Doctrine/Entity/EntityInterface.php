<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping\ClassMetadata;

interface EntityInterface
{
    public static function loadMetadata(ClassMetadata $metadata): void;
}
