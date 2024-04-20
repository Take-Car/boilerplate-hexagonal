<?php

namespace Domain\Message\Query\Movie\All;

use Domain\Collection\Movies;

/**
 * TODO: remove this file after forking the project.
 */
final readonly class Handler
{
    public function __construct(private Movies $movies)
    {
    }

    public function __invoke(Input $input): Output
    {
        return new Output($this->movies->all());
    }
}
