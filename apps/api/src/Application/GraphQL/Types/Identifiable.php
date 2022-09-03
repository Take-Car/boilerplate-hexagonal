<?php

declare(strict_types=1);

namespace Application\GraphQL\Types;

use Domain\Model;
use Overblog\GraphQLBundle\Annotation\Field;
use Overblog\GraphQLBundle\Annotation\TypeInterface;

#[TypeInterface(resolveType: '@=query("resolveType", value)')]
abstract class Identifiable
{
    public function __construct(
        protected readonly Model\Identifiable $identifiable
    ) {
    }

    #[Field(type: 'ID!')]
    public function id(): string
    {
        return (string) $this->identifiable->getId();
    }
}
