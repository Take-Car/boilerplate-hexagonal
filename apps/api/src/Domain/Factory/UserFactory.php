<?php

declare(strict_types=1);

namespace Domain\Factory;

use Domain\Model\User;

interface UserFactory
{
    public function create(string $username, ?string $password): User;
}
