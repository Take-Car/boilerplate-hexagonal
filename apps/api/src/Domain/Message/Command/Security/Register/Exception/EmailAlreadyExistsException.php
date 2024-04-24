<?php

declare(strict_types=1);

namespace Domain\Message\Command\Security\Register\Exception;

final class EmailAlreadyExistsException extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Email \"{$email}\" already exists.");
    }
}
