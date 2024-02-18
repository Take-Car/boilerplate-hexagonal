<?php

namespace specs\Domain\Command\Movie\Delete;

use Domain\Collection\Movies;
use Domain\Command\Movie\Delete\Handler;
use Domain\Command\Movie\Delete\Input;
use Domain\Model\Movie;
use PhpSpec\ObjectBehavior;

class HandlerSpec extends ObjectBehavior
{
    public function let(Movies $movies)
    {
        $this->beConstructedWith($movies);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Handler::class);
    }

    public function it_create_movie(Movies $movies)
    {
        $movie = new Movie('The Matrix', 'Welcome to the Real World', new \DateTimeImmutable('1999-03-31'));
        $input = new Input($movie->uuid);
        $movies->get($movie->uuid)->willReturn($movie);
        $this->__invoke($input);
        $movies->remove($movie)->shouldBeCalled();
    }
}
