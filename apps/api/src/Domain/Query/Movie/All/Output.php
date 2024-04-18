<?php

namespace Domain\Query\Movie\All;

use Domain\Model\Movie;

/**
 * TODO: remove this file after forking the project.
 */
final readonly class Output
{
    /**
     * @param array<Movie> $movies
     */
    public function __construct(public array $movies)
    {
    }
}
