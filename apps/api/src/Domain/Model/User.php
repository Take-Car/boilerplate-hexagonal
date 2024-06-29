<?php

declare(strict_types=1);

namespace Domain\Model;

class User
{
    protected string $hashedPassword;

    public function __construct(protected string $email)
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword(string $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }
}
