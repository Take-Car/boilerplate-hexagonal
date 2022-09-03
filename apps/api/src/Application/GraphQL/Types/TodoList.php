<?php

declare(strict_types=1);

namespace Application\GraphQL\Types;

use Domain\Model;
use Overblog\GraphQLBundle\Annotation\Field;
use Overblog\GraphQLBundle\Annotation\Type;

#[Type(interfaces: ['Identifiable'])]
class TodoList extends Identifiable
{
    public function __construct(
        private readonly Model\TodoList $todoList
    ) {
        parent::__construct($todoList);
    }

    #[Field]
    public function title(): string
    {
        return $this->todoList->getTitle();
    }

    /**
     * @return Todo[]
     */
    #[Field(type: '[Todo!]!')]
    public function todos(): array
    {
        return array_map(fn (Model\Todo $todo) => new Todo($todo), $this->todoList->getTodos());
    }

    #[Field]
    public function length(): int
    {
        return $this->todoList->getLength();
    }
}
