<?php

declare(strict_types=1);

namespace Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Domain\Trait\IdentifiableTrait;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class User implements Identifiable
{
    use IdentifiableTrait;

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private readonly Uuid $id;

    public function __construct(
        ?Uuid $id = null
    ) {
        $this->id = $id ?? Uuid::v4();
    }
}
