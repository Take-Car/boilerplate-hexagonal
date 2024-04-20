<?php

namespace Domain\Message\Command\Movie\Create;

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
        $movie = $this->movies->create(
            $input->title,
            $input->description,
            $input->releaseDate,
        );

        $this->movies->add($movie);
    }
}
