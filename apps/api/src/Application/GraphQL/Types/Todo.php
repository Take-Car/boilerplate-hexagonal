<?php

declare(strict_types=1);

namespace Application\GraphQL\Types;

use Domain\Model;
use Overblog\GraphQLBundle\Annotation\Field;
use Overblog\GraphQLBundle\Annotation\Type;

#[Type(interfaces: ['Identifiable'])]
class Todo extends Identifiable
{
    public function __construct(
        private readonly Model\Todo $todo
    ) {
        parent::__construct($todo);
    }

    #[Field]
    public function isDone(): bool
    {
        return $this->todo->isDone();
    }

    #[Field]
    public function task(): string
    {
        return $this->todo->getTask();
    }
}
