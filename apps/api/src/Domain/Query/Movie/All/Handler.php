<?php

namespace Domain\Query\Movie\All;

use Domain\Collection\Movies;

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
