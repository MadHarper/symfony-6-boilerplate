<?php

namespace App\UI\Http\Schema;

use App\Core\Example\Domain\Entity\Baz;
use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;

class JWTTokenSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'jwt';
    }

    public function getId($obj): ?string
    {
        return null;
    }

    /**
     * @param JWTTokenDTO $resource
     * @param ContextInterface $context
     * @return iterable
     */
    public function getAttributes($resource, ContextInterface $context): iterable
    {
        return [
            'token' => $resource->getToken(),
            'refresh_token' => $resource->getRefreshToken()
        ];
    }

    public function getRelationships($resource, ContextInterface $context): iterable
    {
        return [];
    }
}