<?php

declare(strict_types=1);

namespace Application\GraphQL\Type;

use Domain\Model;
use Overblog\GraphQLBundle\Annotation\Type;

/**
 * @extends Identifiable<Model\User>
 */
#[Type(interfaces: ['Identifiable'])]
class User extends Identifiable
{
    public function __construct(Model\User $user) {
        parent::__construct($user);
    }
}
