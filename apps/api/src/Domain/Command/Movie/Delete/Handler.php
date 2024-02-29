<?php

namespace Domain\Command\Movie\Delete;

use Domain\Collection\Movies;

/**
 * TODO: remove this file after forking the project.
 */
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
