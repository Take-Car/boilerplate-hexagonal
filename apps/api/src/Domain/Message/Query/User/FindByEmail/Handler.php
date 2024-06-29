<?php

declare(strict_types=1);

namespace Domain\Message\Query\User\FindByEmail;

use Domain\Collection\UserCollection;
use Domain\Message\Query\QueryInterface;

final readonly class Handler implements QueryInterface
{
    public function __construct(private UserCollection $userCollection)
    {
    }

    public function __invoke(Input $input): Output
    {
        return new Output($this->userCollection->findByEmail($input->email));
    }
}
