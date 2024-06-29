<?php

declare(strict_types=1);

namespace Domain\Message\Query\User\Get;

final readonly class Input
{
    public function __construct(public string $id)
    {
    }
}
