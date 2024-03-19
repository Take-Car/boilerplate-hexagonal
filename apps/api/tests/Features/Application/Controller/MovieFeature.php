<?php

use Application\Controller\MovieController;
use Symfony\Component\HttpFoundation\Response;
use Tests\Helper;

test(MovieController::class, function () {
    $response = Helper\Http::post('/api/movie');
    expect($response->getStatusCode())->toBe(Response::HTTP_CREATED);
    expect($response->getContent())->toBe('{"message":"Movie created"}');

    $response = Helper\Http::get('/api/movie');
    expect($response->getStatusCode())->toBe(Response::HTTP_OK);
    expect($response->getContent())->toMatch('/\[\{"uuid":"[\w]{8}-[\w]{4}-[\w]{4}-[\w]{4}-[\w]{12}"\}\]/');

    $uuid = json_decode(Helper\Http::getLatestResponse()->getContent())[0]->uuid;
    $response = Helper\Http::get("/api/movie/{$uuid}");
    expect($response->getStatusCode())->toBe(Response::HTTP_OK);
    expect($response->getContent())->toBe('{"uuid":"'.$uuid.'"}');

    $response = Helper\Http::delete("/api/movie/{$uuid}");
    expect($response->getStatusCode())->toBe(Response::HTTP_OK);

    $response = Helper\Http::get("/api/movie/{$uuid}");
    expect($response->getStatusCode())->toBe(Response::HTTP_NOT_FOUND);

    $response = Helper\Http::delete("/api/movie/{$uuid}");
    expect($response->getStatusCode())->toBe(Response::HTTP_NOT_FOUND);
});
