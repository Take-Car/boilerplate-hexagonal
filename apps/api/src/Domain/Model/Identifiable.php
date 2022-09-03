<?php

declare(strict_types=1);

namespace Domain\Model;

use Symfony\Component\Uid\Uuid;

abstract class Identifiable
{
    protected readonly Uuid $id;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}
