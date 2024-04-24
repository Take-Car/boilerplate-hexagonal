<?php

declare(strict_types=1);

namespace Domain\Model;

abstract class User
{
    protected ?string $hashedPassword;

    public function __construct(protected string $email)
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getHashedPassword(): ?string
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword(?string $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }
}
