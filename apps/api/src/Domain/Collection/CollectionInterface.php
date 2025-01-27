<?php

declare(strict_types=1);

namespace Domain\Collection;

/**
 * @template T of object
 */
interface CollectionInterface
{
    /**
     * @param T $entity
     */
    public function add(object $entity): void;

    /**
     * @param T $entity
     */
    public function remove(object $entity): void;
}
