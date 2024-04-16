<?php

declare(strict_types=1);

namespace Domain\Model;

/**
 * TODO: remove this file after forking the project.
 */
class Movie
{
    public function __construct(
        protected string $title,
        protected string $description,
        protected \DateTimeImmutable $releaseDate,
    ) {
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): void
    {
        $this->releaseDate = \DateTimeImmutable::createFromInterface($releaseDate);
    }

    public function getReleaseDate(): \DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
