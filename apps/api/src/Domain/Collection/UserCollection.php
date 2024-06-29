<?php

declare(strict_types=1);

namespace Domain\Collection;

use Domain\Model\User;

interface UserCollection
{
    public function create(string $email, string $password): User;

    public function add(User $user): void;

    public function remove(User $user): void;

    public function get(string $id): User;

    public function findByEmail(string $email): ?User;
}
