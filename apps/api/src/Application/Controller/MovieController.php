<?php

declare(strict_types=1);

namespace Application\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Collection\Movies;
use Domain\Model\Movie as ModelMovie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movie', 'movie_')]
class MovieController
{
    #[Route(name: 'index', methods: Request::METHOD_GET)]
    public function index(Movies $movies): Response
    {
        return new JsonResponse(
            array_map(
                fn (ModelMovie $movie) => $movie->toArray(),
                $movies->all()
            )
        );
    }

    #[Route(name: 'create', methods: Request::METHOD_POST)]
    public function create(EntityManagerInterface $em, Movies $movies): Response
    {
        $movie = new ModelMovie(
            'The Shawshank Redemption',
            'Frank Darabont',
            new \DateTimeImmutable('1994-10-14')
        );

        $movies->add($movie);
        $em->flush();

        return new JsonResponse(['message' => 'Movie created'], Response::HTTP_CREATED);
    }

    #[Route('/{uuid}', name: 'show', methods: Request::METHOD_GET)]
    public function show(Movies $movies, string $uuid): Response
    {
        return new JsonResponse($movies->get($uuid)->toArray());
    }

    #[Route('/{uuid}', name: 'delete', methods: Request::METHOD_DELETE)]
    public function delete(EntityManagerInterface $em, Movies $movies, string $uuid): Response
    {
        $movie = $movies->get($uuid);
        $movies->remove($movie);
        $em->flush();

        return new JsonResponse(['message' => 'Movie deleted']);
    }
}
