<?php

declare(strict_types=1);

namespace Domain\Message\Query\User\FindByEmail;

final readonly class Input
{
    public function __construct(public string $email)
    {
    }
}
