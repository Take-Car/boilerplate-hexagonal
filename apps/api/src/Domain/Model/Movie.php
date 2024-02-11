<?php

declare(strict_types=1);

namespace Domain\Model;

class Movie
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

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getReleaseDate(): \DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function setYear(\DateTimeInterface $releaseDate): void
    {
        $this->releaseDate = \DateTimeImmutable::createFromInterface($releaseDate);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'releaseDate' => $this->releaseDate->format('Y-m-d'),
        ];
    }
}
