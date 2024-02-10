<?php

declare(strict_types=1);

namespace Application\Messenger;

use Closure;

interface WorkflowInterface
{
    /**
     * @param Closure(BusInterface) mixed
     */
    public function handle(\Closure $task): mixed;
}
