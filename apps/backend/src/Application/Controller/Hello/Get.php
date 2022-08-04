<?php

declare(strict_types=1);

namespace Application\Controller\Hello;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Get
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse([
            'payload' => 'Hello world!',
        ]);
    }
}
