<?php

use Domain\Collection\Movies;
use Domain\Model\Movie;
use Domain\Query\Movie\All\Handler;
use Domain\Query\Movie\All\Input;
use Domain\Query\Movie\All\Output;

test('retrieve a movie by its uuid', function (): void {
    $movies = mock(Movies::class);
    $movieA = mock(Movie::class);
    $movieB = mock(Movie::class);
    $movieC = mock(Movie::class);
    $handler = new Handler($movies);

    $movies
        ->shouldReceive('all')
        ->andReturn([
            $movieA,
            $movieB,
            $movieC,
        ])
    ;

    $output = $handler->__invoke(new Input());

    expect($output)
        ->toBeInstanceOf(Output::class)
        ->and($output->movies)
        ->toBe([
            $movieA,
            $movieB,
            $movieC,
        ])
    ;
});
