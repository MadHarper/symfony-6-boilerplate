<?php

namespace App\UI\Http\Schema;

use App\Core\Example\Domain\Entity\Baz;
use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;

class JWTTokenDTO
{
    private string $token;
    private string $refreshToken;

    public function __construct(string $token, string $refreshToken)
    {
        $this->token = $token;
        $this->refreshToken = $refreshToken;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}