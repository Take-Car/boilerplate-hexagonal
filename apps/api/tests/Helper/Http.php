<?php

namespace Tests\Helper;

use Doctrine\ORM\EntityManagerInterface;
use Infrastructure\Symfony\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class Http extends AbstractHelper
{
    private static Kernel $kernel;
    private static EntityManagerInterface $entityManager;
    private static ?Response $latestResponse = null;

    #[\Override]
    public static function setUpBeforeClass(): void
    {
        static::$kernel = new Kernel('test', false);
    }

    #[\Override]
    public static function setUp(): void
    {
        static::$kernel->boot();
        static::$entityManager = static::$kernel->getContainer()->get('doctrine.orm.default_entity_manager');
        static::$entityManager->beginTransaction();
    }

    #[\Override]
    public static function tearDown(): void
    {
        static::$entityManager->rollback();
        static::$entityManager->clear();
    }

    #[\Override]
    public static function tearDownAfterClass(): void
    {
        static::$entityManager->getConnection()->close();
        static::$kernel->shutdown();
    }

    private static function request(string $method, string $uri, array $parameters = []): Response
    {
        $request = Request::create($uri, $method, $parameters);
        $response = static::$kernel->handle($request);
        static::$kernel->terminate($request, $response);

        if ($response instanceof StreamedResponse) {
            ob_start();
            $response = $response->sendContent();
            $content = ob_get_clean();
            $response = new Response(
                $content,
                $response->getStatusCode(),
                $response->headers->all()
            );
        }

        static::$latestResponse = $response;

        return $response;
    }

    public static function get(string $uri, array $parameters = []): Response
    {
        return self::request(Request::METHOD_GET, $uri, $parameters);
    }

    public static function post(string $uri, array $parameters = []): Response
    {
        return self::request(Request::METHOD_POST, $uri, $parameters);
    }

    public static function delete(string $uri, array $parameters = []): Response
    {
        return self::request(Request::METHOD_DELETE, $uri, $parameters);
    }

    public static function getLatestResponse(): ?Response
    {
        return static::$latestResponse;
    }
}
