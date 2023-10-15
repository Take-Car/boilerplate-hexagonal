<?php

namespace Domain\Queue;

use Domain\Query\QueryInterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): mixed;
}
