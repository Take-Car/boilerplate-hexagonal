<?php

namespace specs\Domain\Model;

use Domain\Model\Movie;
use PhpSpec\ObjectBehavior;

class MovieSpec extends ObjectBehavior
{
    private const string RELEASE_DATE = '1999-03-31';

    public function let()
    {
        $this->beConstructedWith('The Matrix', 'Welcome to the Real World', new \DateTimeImmutable(self::RELEASE_DATE));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Movie::class);
    }

    public function it_has_a_title()
    {
        $this->getTitle()->shouldReturn('The Matrix');
    }

    public function it_has_a_description()
    {
        $this->getDescription()->shouldReturn('Welcome to the Real World');
    }

    public function it_has_a_release_date()
    {
        $this->getReleaseDate()->shouldBeLike(new \DateTimeImmutable(self::RELEASE_DATE));
    }
}
