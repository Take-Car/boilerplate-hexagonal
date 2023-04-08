<?php

declare(strict_types=1);

namespace Domain\Trait;

trait IdentifiableTrait
{
    public function getId(): string
    {
        return $this->id->toRfc4122();
    }

    public function __toString(): string
    {
        return $this->getId();
    }   
}
