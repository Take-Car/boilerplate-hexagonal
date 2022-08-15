<?php

declare(strict_types=1);

namespace Application\GraphQL\Resolver;

use Domain\Model\Identifiable;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;
use ReflectionClass;
use RuntimeException;

class Type implements QueryInterface, AliasedInterface
{
    public function resolve($input)
    {
        if (!$input instanceof Identifiable) {
            throw new RuntimeException(sprintf('Could not resolve type of %s', $input::class));
        }

        $reflectedInput = new ReflectionClass($input);

        return $reflectedInput->getShortName();
    }

    public static function getAliases(): array
    {
        return ['resolve' => 'resolveType'];
    }
}
