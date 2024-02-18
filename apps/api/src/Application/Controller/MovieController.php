<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\BusInterface;
use Domain\Collection\Movies;
use Domain\Command\Movie\Create;
use Domain\Command\Movie\Delete;
use Domain\Query\Movie\All;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedJsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movie', 'movie_')]
final class MovieController
{
    #[Route(name: 'index', methods: Request::METHOD_GET)]
    public function index(BusInterface $bus): Response
    {
        $movies = $bus->ask(new All\Input())->movies;

        return new StreamedJsonResponse($movies);
    }

    #[Route(name: 'create', methods: Request::METHOD_POST)]
    public function create(BusInterface $bus): Response
    {
        try {
            $bus->dispatch(new Create\Input(
                'The Shawshank Redemption',
                'Frank Darabont',
                new \DateTimeImmutable('1994-10-14')
            ));
        } catch (\Throwable $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['message' => 'Movie created'], Response::HTTP_CREATED);
    }

    #[Route('/{uuid}', name: 'show', methods: Request::METHOD_GET)]
    public function show(Movies $movies, string $uuid): Response
    {
        return new JsonResponse($movies->get($uuid));
    }

    #[Route('/{uuid}', name: 'delete', methods: Request::METHOD_DELETE)]
    public function delete(BusInterface $bus, string $uuid): Response
    {
        $bus->dispatch(new Delete\Input($uuid));

        return new JsonResponse(['message' => 'Movie deleted']);
    }
}
