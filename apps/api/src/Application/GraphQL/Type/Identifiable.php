<?php

declare(strict_types=1);

namespace Application\GraphQL\Type;

use Domain\Model;
use Overblog\GraphQLBundle\Annotation\Field;
use Overblog\GraphQLBundle\Annotation\TypeInterface;

/**
 * @template T of Model\Identifiable
 */
#[TypeInterface(resolveType: '@=query("resolveType", value)')]
abstract class Identifiable
{
    public function __construct(
        /**
         * @var T $identifiable
         */
        protected readonly Model\Identifiable $model
    ) {
    }

    #[Field(type: 'ID!')]
    public function id(): string
    {
        return $this->model->getId();
    }
}
