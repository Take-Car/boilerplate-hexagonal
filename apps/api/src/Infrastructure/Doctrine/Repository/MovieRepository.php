<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Domain\Model\Movie;

/**
 * @extends AbstractRepository<Movie>
 * TODO: remove this file after forking the project
 */
class MovieRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }
}
