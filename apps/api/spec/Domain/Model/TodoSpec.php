<?php

namespace spec\Domain\Model;

use Domain\Model\Todo;
use PhpSpec\ObjectBehavior;

class TodoSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('task');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Todo::class);
    }

    function it_gets_task()
    {
        $this->getTask()->shouldReturn('task');
    }

    function it_sets_task()
    {
        $this->setTask('toto');

        $this->getTask()->shouldReturn('toto');
    }

    function it_is_done()
    {
        $this->isDone()->shouldReturn(false);
    }

    function it_done()
    {
        $this->done();

        $this->isDone()->shouldReturn(true);
    }

    function it_undo()
    {
        $this->done();
        $this->undo();
        $this->isDone()->shouldReturn(false);
    }
}
