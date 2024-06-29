<?php

declare(strict_types=1);

namespace Domain\Message\Command\User\Remove;

use Domain\Collection\UserCollection;
use Domain\Message\Command\CommandInterface;

final readonly class Handler implements CommandInterface
{
    public function __construct(private UserCollection $userCollection)
    {
    }

    public function __invoke(Input $input): void
    {
        $user = $this->userCollection->get($input->id);
        $this->userCollection->remove($user);
    }
}
