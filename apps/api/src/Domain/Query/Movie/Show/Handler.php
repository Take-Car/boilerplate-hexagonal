<?php

declare(strict_types=1);

namespace Domain\Query\Movie\Show;

use Domain\Collection\Movies;

final class Handler
{
    public function __construct(private readonly Movies $movies)
    {
    }

    public function __invoke(Input $input): Output
    {
        return new Output($this->movies->get($input->uuid));
    }
}
