<?php

declare(strict_types=1);

namespace Domain\Message\Command\Security\Register;

use Domain\Collection\UsersInterface;

final readonly class Handler
{
    public function __construct(private UsersInterface $users)
    {
    }

    public function __invoke(Input $input): void
    {
        if ($this->users->exists($input->email)) {
            throw new Exception\EmailAlreadyExistsException($input->email);
        }

        $this->users->add($this->users->create($input->email, $input->plainPassword));
    }
}
