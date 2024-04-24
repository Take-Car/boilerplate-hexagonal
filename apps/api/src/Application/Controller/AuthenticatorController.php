<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\BusInterface;
use Domain;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/auth', name: 'auth_')]
final readonly class AuthenticatorController
{
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(BusInterface $bus): Response
    {
        try {
            $bus->dispatch(new Domain\Message\Command\Security\Register\Input(
                email: 'test@toto.fr',
                plainPassword: 'password',
            ));
        } catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new Response();
    }

    #[Route('/signin', name: 'signin', methods: ['POST'])]
    public function signin(#[CurrentUser] ?Domain\Model\User $currentUser): Response
    {
        if (!$currentUser instanceof Domain\Model\User) {
            return new Response('User not found', Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            'email' => $currentUser->getEmail(),
            'token' => sha1($currentUser->getEmail().$currentUser->getHashedPassword()),
        ]);
    }
}
