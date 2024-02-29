<?php

declare(strict_types=1);

namespace Domain\Query\Movie\Show;

use Domain\Query\QueryInterface;

final class Input implements QueryInterface
{
    public function __construct(public readonly string $uuid)
    {
    }
}
