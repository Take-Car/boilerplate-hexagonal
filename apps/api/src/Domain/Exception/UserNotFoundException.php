<?php

declare(strict_types=1);

namespace Domain\Exception;

final class UserNotFoundException extends \Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function withId(string $id): self
    {
        return new self("User with id $id not found");
    }

    public static function withEmail(string $email): self
    {
        return new self("User with email $email not found");
    }
}
