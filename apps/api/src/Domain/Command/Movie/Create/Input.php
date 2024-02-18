<?php

namespace Domain\Command\Movie\Create;

use Domain\Command\CommandInterface;

/**
 * TODO: remove this file after forking the project
 */
final readonly class Input implements CommandInterface
{
    public function __construct(
        public string $title,
        public string $description,
        public \DateTimeImmutable $releaseDate,
    ) {
    }
}
