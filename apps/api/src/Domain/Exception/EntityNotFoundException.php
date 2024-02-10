<?php

declare(strict_types=1);

namespace Domain\Exception;

class EntityNotFoundException extends \Exception
{
    /**
     * @param class-string $className
     */
    public function __construct(string $className, string $uuid)
    {
        parent::__construct("Entity {$className} with uuid {$uuid} not found.");
    }
}
