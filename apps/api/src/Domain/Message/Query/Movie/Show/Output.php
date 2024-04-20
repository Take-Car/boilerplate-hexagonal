<?php

declare(strict_types=1);

namespace Domain\Message\Query\Movie\Show;

use Domain\Model\Movie;

final class Output
{
    public function __construct(public readonly Movie $movie)
    {
    }
}
