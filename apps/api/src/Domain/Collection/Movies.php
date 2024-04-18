<?php

declare(strict_types=1);

namespace Domain\Collection;

use Domain\Model\Movie;

/**
 * TODO: remove this file after forking the project.
 */
interface Movies
{
    public function create(string $title, string $description, \DateTimeInterface $releaseDate): Movie;

    public function add(Movie $movie): void;

    public function remove(Movie $movie): void;

    /**
     * @throw \Domain\Collection\Exception\EntityNotFoundException
     */
    public function get(string $uuid): Movie;

    /**
     * @return array<Movie>
     */
    public function all(): array;
}
