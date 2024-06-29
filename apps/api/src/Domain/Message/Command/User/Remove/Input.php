<?php

declare(strict_types=1);

namespace Domain\Message\Command\User\Remove;

final readonly class Input
{
    public function __construct(public string $id)
    {
    }
}
