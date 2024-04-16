<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Collection;

use Domain;
use Infrastructure\Doctrine\Entity\Movie;
use Infrastructure\Doctrine\Repository\MovieRepository;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

/**
 * TODO: remove this file after forking the project.
 */
#[AsAlias]
final readonly class Movies implements Domain\Collection\Movies
{
    public function __construct(private MovieRepository $repository)
    {
    }

    #[\Override]
    public function create(string $title, string $description, \DateTimeInterface $releaseDate): Domain\Model\Movie
    {
        return new Movie($title, $description, \DateTimeImmutable::createFromInterface($releaseDate));
    }

    #[\Override]
    public function add(Domain\Model\Movie $movie): void
    {
        $this->repository->add($movie);
    }

    #[\Override]
    public function remove(Domain\Model\Movie $movie): void
    {
        $this->repository->remove($movie);
    }

    /**
     * @throws Domain\Collection\Exception\EntityNotFoundException
     */
    #[\Override]
    public function get(string $uuid): Movie
    {
        $movie = $this->repository->find($uuid);

        if (!$movie instanceof Movie) {
            throw new Domain\Collection\Exception\EntityNotFoundException(Movie::class, $uuid);
        }

        return $movie;
    }

    /**
     * @return array<int,Domain\Model\Movie>
     */
    #[\Override]
    public function all(): array
    {
        return $this->repository->findAll();
    }
}
