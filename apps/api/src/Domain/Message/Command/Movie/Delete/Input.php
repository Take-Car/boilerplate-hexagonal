<?php

namespace Domain\Message\Command\Movie\Delete;

use Domain\Message\Command\CommandInterface;

/**
 * TODO: remove this file after forking the project.
 */
final readonly class Input implements CommandInterface
{
    public function __construct(public string $uuid)
    {
    }
}
