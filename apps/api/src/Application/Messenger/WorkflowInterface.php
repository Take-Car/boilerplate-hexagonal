<?php

declare(strict_types=1);

namespace Application\Messenger;

interface WorkflowInterface
{
    /**
     * @param \Closure(BusInterface): mixed $task
     */
    public function run(\Closure $task): mixed;
}
