<?php

declare(strict_types=1);

namespace Application\Controller\Security\SignUp;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sign-up', name: 'sign_up', methods: ['POST'])]
final class SignUpController
{
    public function __invoke(#[MapRequestPayload] Payload $payload): JsonResponse
    {
        return new JsonResponse([
            'email' => $payload->email,
            'password' => $payload->password,
        ]);
    }
}
