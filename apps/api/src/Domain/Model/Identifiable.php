<?php

declare(strict_types=1);

namespace Domain\Model;

interface Identifiable
{
    public function getId(): string;

    public function __toString(): string;
}
