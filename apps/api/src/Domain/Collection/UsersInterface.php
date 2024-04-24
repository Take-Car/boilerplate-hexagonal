<?php

declare(strict_types=1);

namespace Domain\Collection;

use Domain\Model\User;

interface UsersInterface
{
    public function create(string $email, string $plainPassword): User;

    public function add(User $user): void;

    public function remove(User $user): void;

    public function get(string $email): ?User;

    public function exists(string $email): bool;
}
