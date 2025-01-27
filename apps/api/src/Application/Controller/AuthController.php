<?php

namespace Application\Controller;

use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController
{
    #[Route('/login_check', name: 'api_login_check', methods: 'POST')]
    #[OA\Post(
        path: '/login_check',
        summary: 'Authenticate and get a JWT token',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: 'object',
                properties: [
                    new OA\Property(property: 'username', type: 'string', example: 'userexample.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'password'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'JWT token response',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [new OA\Property(property: 'token', type: 'string', example: 'your-jwt-token')]
                )
            ),
            new OA\Response(response: 401, description: 'Invalid credentials'),
        ]
    )]
    public function loginCheck(): Response
    {
        // This method will never be executed because LexikJWTAuthenticationBundle handles it.
        return new JsonResponse([]);
    }
}
