<?php

namespace spec\Domain\Model;

use Domain\Model\Todo;
use Domain\Model\TodoList;
use PhpSpec\ObjectBehavior;

class TodoListSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('title');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TodoList::class);
    }

    function it_gets_todos()
    {
        $this->getTodos()->shouldReturn([]);
    }

    function it_gets_lenght()
    {
        $this->getLength()->shouldReturn(0);
    }

    function it_adds_todo(Todo $todo)
    {
        $this->addTodo($todo);
        $this->getTodos()->shouldReturn([$todo->getWrappedObject()]);
    }

    function it_removes_todo(Todo $todo)
    {
        $this->addTodo($todo);
        $this->getTodos()->shouldReturn([$todo->getWrappedObject()]);

        $this->removeTodo($todo);
        $this->getTodos()->shouldReturn([]);
    }

    function it_gets_title()
    {
        $this->getTitle()->shouldReturn('title');
    }

    function it_sets_title()
    {
        $this->getTitle()->shouldReturn('title');
        $this->setTitle('updated');
        $this->getTitle()->shouldReturn('updated');
    }
}
