<?php

namespace Domain\Command\Movie\Delete;

use Domain\Command\CommandInterface;

final readonly class Input implements CommandInterface
{
    public function __construct(public string $uuid)
    {
    }
}
