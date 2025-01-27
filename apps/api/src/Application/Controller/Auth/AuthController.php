<?php

namespace Application\Controller\Auth;

use Application\Controller\Auth\DTO\AuthRequest;
use Doctrine\ORM\EntityManagerInterface;
use Application\Factory\UserFactory;
use Application\Collection\UserCollectionInterface;
use Application\Controller\Auth\DTO\InvalidCredentials;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/auth', name: 'api_auth_')]
final readonly class AuthController
{
    #[Route('/login', name: 'login', methods: 'POST')]
    #[OA\RequestBody(content: new Model(type: AuthRequest::class))]
    #[OA\Response(
        response: Response::HTTP_OK,
        description: 'Returns a JWT token',
        content: new OA\JsonContent(
            type: 'object',
            properties: [new OA\Property(property: 'token', type: 'string')]
        )
    )]
    #[OA\Response(
        response: Response::HTTP_BAD_REQUEST,
        description: 'Invalid credentials',
        content: new OA\JsonContent(
            type: 'object',
            properties: [new OA\Property(property: 'error', type: 'string')]
        )
    )]
    public function login(
        UserCollectionInterface $userCollection,
        #[MapRequestPayload] AuthRequest $request,
        JWTTokenManagerInterface $JWTManager,
        UserPasswordHasherInterface $passwordHasher,
    ): Response
    {
        $user = $userCollection->findOneByUsername($request->username);

        if (!$user instanceof UserInterface
            || !$user instanceof PasswordAuthenticatedUserInterface
            || !$passwordHasher->isPasswordValid($user, $request->password)) {
            return new JsonResponse([ 'error' => 'Invalid credentials' ], Response::HTTP_BAD_REQUEST);
        }

        $token = $JWTManager->create($user);

        return new JsonResponse([ 'token' => $token ]);
    }

    #[Route('/register', name: 'register', methods: 'POST')]
    #[OA\RequestBody(content: new Model(type: AuthRequest::class))]
    #[OA\Response(
        response: Response::HTTP_CREATED,
        description: 'User created',
        content: new OA\JsonContent(
            type: 'object',
            properties: [new OA\Property(property: 'token', type: 'string')]
        )
    )]
    public function register(
        UserFactory $userFactory,
        EntityManagerInterface $entityManager,
        UserCollectionInterface $userCollection,
        #[MapRequestPayload] AuthRequest $request,
    ): Response
    {
        $entityManager->beginTransaction();

        $user = $userFactory->create($request->username, $request->password);
        $userCollection->add($user);
        $entityManager->flush();

        $entityManager->commit();

        return new JsonResponse([ 'message' => 'User created' ], Response::HTTP_CREATED);
    }
}
