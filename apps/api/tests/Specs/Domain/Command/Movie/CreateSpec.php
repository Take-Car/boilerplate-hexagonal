<?php

use Domain\Collection\Movies;
use Domain\Command\Movie\Create\Handler;
use Domain\Command\Movie\Create\Input;
use Domain\Model\Movie;

test('creates a movie with given informations', function (): void {
    $input = new Input('The Matrix', 'Welcome to the Real World', new DateTimeImmutable('1999-03-31'));
    $movies = mock(Movies::class);
    $handler = new Handler($movies);

    $movies
        ->shouldReceive('add')
        ->withArgs(fn (Movie $movie) => (bool) expect($movie->getTitle())->toBe('The Matrix')
            ->and($movie->getDescription())->toBe('Welcome to the Real World')
            ->and($movie->getReleaseDate()->format('Y-m-d'))->toBe('1999-03-31')
        );

    $handler->__invoke($input);
});
