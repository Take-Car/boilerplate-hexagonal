<?php

declare(strict_types=1);

namespace Application\GraphQL\Query;

use Application\GraphQL\Type\User;
use Domain\Model\User as ModelUser;
use Overblog\GraphQLBundle\Annotation\Provider;
use Overblog\GraphQLBundle\Annotation\Query;

#[Provider(targetQueryTypes: 'Query')]
class Users
{
    #[Query(type: '[User!]!')]
    public function users()
    {
        return [new User(new ModelUser())];
    }
}
