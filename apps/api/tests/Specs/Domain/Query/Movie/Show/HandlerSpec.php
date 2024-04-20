
<?php

use Domain\Collection\Movies;
use Domain\Message\Query\Movie\Show\Handler;
use Domain\Message\Query\Movie\Show\Input;
use Domain\Message\Query\Movie\Show\Output;
use Domain\Model\Movie;

test('retrieve a movie by its uuid', function (): void {
    $movies = mock(Movies::class);
    $movie = mock(Movie::class);
    $handler = new Handler($movies);

    $movies
        ->shouldReceive('get')
        ->withArgs(['uuid'])
        ->andReturn($movie)
        ->once()
    ;

    $output = $handler->__invoke(new Input('uuid'));

    expect($output)
        ->toBeInstanceOf(Output::class)
        ->and($output->movie)->toBe($movie)
    ;
});
