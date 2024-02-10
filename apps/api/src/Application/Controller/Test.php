<?php

declare(strict_types=1);

namespace Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/test', 'test_')]
class Test
{
    #[Route(name: 'index', methods: 'GET')]
    public function index(): Response
    {
        return new JsonResponse(['message' => 'hello world']);
    }
}
