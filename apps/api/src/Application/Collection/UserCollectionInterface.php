<?php

declare(strict_types=1);

namespace Application\Collection;

use Domain;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserCollectionInterface extends Domain\Collection\CollectionInterface
{
    public function findOneByUsername(string $username): (PasswordAuthenticatedUserInterface & UserInterface) | null;
}
