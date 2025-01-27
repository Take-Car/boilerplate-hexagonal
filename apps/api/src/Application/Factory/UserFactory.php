<?php

declare(strict_types=1);

namespace Application\Factory;

use Domain;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserFactory extends Domain\Factory\UserFactory
{
    public function create(string $username, string $password): UserInterface&PasswordAuthenticatedUserInterface&Domain\Model\User;
}
