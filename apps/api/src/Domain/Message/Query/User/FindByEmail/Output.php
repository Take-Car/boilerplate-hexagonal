<?php

declare(strict_types=1);

namespace Domain\Message\Query\User\FindByEmail;

use Domain\Model\User;

final readonly class Output
{
    public function __construct(public ?User $user)
    {
    }
}
