<?php

declare(strict_types=1);

namespace Domain\Model;

/**
 * TODO: remove this file after forking the project
 */
readonly class Movie
{
    public readonly string $uuid;

    public function __construct(
        private string $title,
        private string $description,
        private \DateTimeImmutable $releaseDate,
    ) {
        $this->uuid = \uuid_create();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getReleaseDate(): \DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
