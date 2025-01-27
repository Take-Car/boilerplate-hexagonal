<?php

declare(strict_types=1);

namespace Application\Factory;

use Symfony\Component\Security\Core\User\UserInterface;

interface UserFactory
{
    public function create(string $username, string $password): UserInterface;
}
