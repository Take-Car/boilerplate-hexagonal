<?php

namespace specs\Domain\Query\Movie\All;

use Domain\Collection\Movies;
use Domain\Model\Movie;
use Domain\Query\Movie\All\Handler;
use Domain\Query\Movie\All\Input;
use Domain\Query\Movie\All\Output;
use PhpSpec\ObjectBehavior;

class HandlerSpec extends ObjectBehavior
{
    function let(Movies $movies)
    {
        $this->beConstructedWith($movies);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Handler::class);
    }

    function it_return_all_movies(Movies $movies)
    {
        $matrix = new Movie('The Matrix', 'Welcome to the Real World', new \DateTimeImmutable('1999-03-31'));
        $harryPotter = new Movie('Harry Potter', 'Welcome to the Magic World', new \DateTimeImmutable('2001-11-16'));
        $movies->all()
            ->shouldBeCalled()
            ->willReturn([$matrix, $harryPotter]);
        ;
        $output = $this->__invoke(new Input());
        $output->shouldBeAnInstanceOf(Output::class);
        $output->movies->shouldBeLike([$matrix, $harryPotter]);
    }
}
