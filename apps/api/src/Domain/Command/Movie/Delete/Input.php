<?php

namespace Domain\Command\Movie\Delete;

use Domain\Command\CommandInterface;

/**
 * TODO: remove this file after forking the project.
 */
final readonly class Input implements CommandInterface
{
    public function __construct(public string $uuid)
    {
    }
}
