<?php

declare(strict_types=1);

namespace Domain\Message\Query\Movie\Show;

use Domain\Message\Query\QueryInterface;

final class Input implements QueryInterface
{
    public function __construct(public readonly string $uuid)
    {
    }
}
