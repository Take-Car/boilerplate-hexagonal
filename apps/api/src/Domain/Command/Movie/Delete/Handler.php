<?php

namespace Domain\Command\Movie\Delete;

use Domain\Collection\Movies;
use Domain\Model\Movie;

final readonly class Handler
{
    public function __construct(private Movies $movies)
    {
    }

    public function __invoke(Input $input): void
    {
        $this->movies->remove($this->movies->get($input->uuid));
    }
}
