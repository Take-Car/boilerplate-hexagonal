<?php

namespace Domain\Query\Movie\All;

use Domain\Model\Movie;

final readonly class Output
{
    /**
     * @param iterable<Movie> $movies
     */
    public function __construct(public iterable $movies)
    {
    }
}
