<?php

declare(strict_types=1);

namespace Domain\Model;

abstract class User
{
    /**
     * @var non-empty-string
     */
    public string $username;

    /**
     * @var null|non-empty-string
     */
    public ?string $password;
}
