<?php

declare(strict_types=1);

namespace Application\GraphQL\Resolver;

use Application\GraphQL\Types\TodoList as TodoListType;
use Domain\Model;
use Overblog\GraphQLBundle\Annotation as GQL;

#[GQL\Provider(targetQueryTypes: 'Query')]
class TodoList
{
    /**
     * @return TodoListType[]
     */
    #[GQL\Query(type: '[TodoList!]!')]
    public function todoLists(): array
    {
        $todo = new Model\Todo('My first todo list');
        $todoList = new Model\TodoList('Simple example without database');
        $todoList->addTodo($todo);

        return [new TodoListType($todoList)];
    }
}
