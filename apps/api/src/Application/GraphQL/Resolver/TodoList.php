<?php

declare(strict_types=1);

namespace Application\GraphQL\Resolver;

use Domain\Model;
use Application\GraphQL\Types;
use Overblog\GraphQLBundle\Annotation as GQL;

#[GQL\Provider(targetQueryTypes: 'Query')]
class TodoList
{
    /**
     * @return todoLists[] 
     */
    #[GQL\Query(type: '[TodoList!]!')]
    public function todoLists(): array
    {
        $todo = new Model\Todo('My first todo list');
        $todoList = new Model\TodoList('Simple example without database');
        $todoList->addTodo($todo);

        return [new Types\TodoList($todoList)];
    }
}
