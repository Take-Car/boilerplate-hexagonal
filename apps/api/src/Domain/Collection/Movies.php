<?php

declare(strict_types=1);

namespace Domain\Collection;

use Domain\Model\Movie;

interface Movies
{
    public function add(Movie $movie): void;

    public function remove(Movie $movie): void;

    public function get(string $uuid): Movie;

    /**
     * @return iterable<Movie>
     */
    public function all(): iterable;
}
