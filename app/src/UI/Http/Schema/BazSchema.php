<?php

namespace App\UI\Http\Schema;

use App\Core\Example\Domain\Entity\Baz;
use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;

class BazSchema extends BaseSchema
{

    public function getType(): string
    {
        return 'baz';
    }

    /**
     * @param Baz $baz
     * @return string|null
     */
    public function getId($baz): ?string
    {
        return $baz->getId();
    }

    /**
     * @param Baz $resource
     * @param ContextInterface $context
     * @return iterable
     */
    public function getAttributes($resource, ContextInterface $context): iterable
    {
        return [
            'name' => $resource->getName()->getName(),
            'age' => $resource->getAge()->getAge()
        ];
    }

    public function getRelationships($resource, ContextInterface $context): iterable
    {
        return [];
    }
}