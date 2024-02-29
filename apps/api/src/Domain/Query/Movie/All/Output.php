<?php

namespace Domain\Query\Movie\All;

use Domain\Model\Movie;

/**
 * TODO: remove this file after forking the project.
 */
final readonly class Output
{
    /**
     * @param iterable<Movie> $movies
     */
    public function __construct(public iterable $movies)
    {
    }
}
