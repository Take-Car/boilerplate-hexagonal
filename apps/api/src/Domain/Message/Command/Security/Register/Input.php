<?php

declare(strict_types=1);

namespace Domain\Message\Command\Security\Register;

use Domain\Message\Command\CommandInterface;

final readonly class Input implements CommandInterface
{
    public function __construct(
        public string $email,
        public string $plainPassword,
    ) {
    }
}
