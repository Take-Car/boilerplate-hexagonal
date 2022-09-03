<?php

declare(strict_types=1);

namespace Domain\Model;

class TodoList extends Identifiable
{
    /**
     * @var Todo[]
     */
    private array $todos = [];

    public function __construct(
        private string $title
    ) {
        parent::__construct();
    }

    /**
     * @return Todo[]
     */
    public function getTodos(): array
    {
        return $this->todos;
    }

    public function getLength(): int
    {
        return count($this->todos);
    }

    public function addTodo(Todo $todo): void
    {
        $this->todos[] = $todo;
    }

    public function removeTodo(Todo $toDelete): void
    {
        $this->todos = array_filter($this->todos, fn (Todo $todo) => $todo !== $toDelete);
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
