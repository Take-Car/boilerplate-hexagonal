<?php

use Domain\Collection\Movies;
use Domain\Command\Movie\Delete\Handler;
use Domain\Command\Movie\Delete\Input;
use Domain\Model\Movie;

test('delete the movie by its uuid', function (): void {
    $movies = mock(Movies::class);
    $movie = mock(Movie::class);
    $handler = new Handler($movies);

    $movies
        ->shouldReceive('get')
        ->withArgs(['uuid'])
        ->andReturn($movie)
        ->once()
    ;

    $movies
        ->shouldReceive('remove')
        ->withArgs([$movie])
        ->once()
    ;

    $handler->__invoke(new Input('uuid'));
});
