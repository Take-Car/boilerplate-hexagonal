<?php

declare(strict_types=1);

namespace Domain\Message\Command\User\Create;

use Domain\Collection\UserCollection;
use Domain\Message\Command\CommandInterface;

final readonly class Handler implements CommandInterface
{
    public function __construct(private UserCollection $userCollection)
    {
    }

    public function __invoke(Input $input): void
    {
        $user = $this->userCollection->create($input->email, $input->password);

        $this->userCollection->add($user);
    }
}
