<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Collection;

use Domain\Collection\Movies as CollectionMovies;
use Domain\Exception\EntityNotFoundException;
use Domain\Model\Movie;
use Infrastructure\Doctrine\Repository\MovieRepository;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

#[AsAlias]
class Movies implements CollectionMovies
{
    public function __construct(private readonly MovieRepository $repository)
    {
    }

    #[\Override]
    public function add(Movie $movie): void
    {
        $this->repository->add($movie);
    }

    #[\Override]
    public function remove(Movie $movie): void
    {
        $this->repository->remove($movie);
    }

    #[\Override]
    public function get(string $uuid): Movie
    {
        $movie = $this->repository->find($uuid);

        if (!$movie instanceof Movie) {
            throw new EntityNotFoundException(Movie::class, $uuid);
        }

        return $movie;
    }

    /**
     * @return Movie[]
     */
    #[\Override]
    public function all(): array
    {
        return $this->repository->findAll();
    }
}
