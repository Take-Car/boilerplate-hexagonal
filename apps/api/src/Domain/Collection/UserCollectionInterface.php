<?php

declare(strict_types=1);

namespace Domain\Collection;

use Domain\Model\User;

/**
 * @extends CollectionInterface<User>
 */
interface UserCollectionInterface extends CollectionInterface
{
    public function findOneByUsername(string $username): ?User;
}
