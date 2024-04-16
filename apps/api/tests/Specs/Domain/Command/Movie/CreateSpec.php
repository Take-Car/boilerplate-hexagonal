<?php

use Domain\Collection\Movies;
use Domain\Command\Movie\Create\Handler;
use Domain\Command\Movie\Create\Input;
use Domain\Model\Movie;

test('creates a movie with given informations', function (): void {
    $releaseDate = new DateTimeImmutable('1999-03-31');
    $input = new Input('The Matrix', 'Welcome to the Real World', $releaseDate);
    $movies = mock(Movies::class);
    $mock = mock(Movie::class);
    $handler = new Handler($movies);

    $movies
        ->shouldReceive('create')
        ->with('The Matrix', 'Welcome to the Real World', $releaseDate)
        ->andReturn($mock)
        ->once();

    $movies
        ->shouldReceive('add')
        ->withArgs([$mock])
        ->once();

    $handler->__invoke($input);
});
