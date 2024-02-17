<?php

namespace specs\Domain\Command\Movie\Create;

use Domain\Collection\Movies;
use Domain\Command\Movie\Create\Handler;
use Domain\Command\Movie\Create\Input;
use Domain\Model\Movie;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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

    public function it_create_movie(Movies $movies)
    {
        $input = new Input('The Matrix', 'Welcome to the Real World', new \DateTimeImmutable('1999-03-31'));
        $this->__invoke($input);
        $movies->add(Argument::that(static function(Movie $movie) {
            return 'The Matrix' === $movie->getTitle()
                && 'Welcome to the Real World' === $movie->getDescription()
                && '1999-03-31' === $movie->getReleaseDate()->format('Y-m-d');
        }));
    }
}
