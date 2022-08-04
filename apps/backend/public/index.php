<?php

declare(strict_types=1);

use Infrastructure\Symfony\Kernel;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__).'/vendor/autoload.php';

$env = (string) $_ENV['APP_ENV'];
$debug = (bool) $_ENV['APP_DEBUG'];

$request = Request::createFromGlobals();

$request->setTrustedProxies(
    [
        '127.0.0.1',
        '10.20.110.0/24',
        '10.20.120.0/24',
        '10.20.130.0/24',
    ],
    Request::HEADER_X_FORWARDED_TRAEFIK
);

$kernel = new Kernel($env, $debug);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
