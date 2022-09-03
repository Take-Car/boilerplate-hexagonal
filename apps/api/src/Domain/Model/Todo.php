<?php

declare(strict_types=1);

namespace Domain\Model;

class Todo extends Identifiable
{
    public function __construct(
        private string $task,
        private bool $done = false
    ) {
        parent::__construct();
    }

    public function getTask(): string
    {
        return $this->task;
    }

    public function setTask(string $task): void
    {
        $this->task = $task;
    }

    public function isDone(): bool
    {
        return $this->done;
    }

    public function done(): void
    {
        $this->done = true;
    }

    public function undone(): void
    {
        $this->done = false;
    }
}
