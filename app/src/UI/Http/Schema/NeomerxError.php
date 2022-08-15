<?php

namespace App\UI\Http\Schema;

use Neomerx\JsonApi\Contracts\Schema\ErrorInterface;

class NeomerxError implements ErrorInterface
{

    public function getId()
    {
        return null;
    }

    public function getLinks(): ?iterable
    {
        return null;
    }

    public function getTypeLinks(): ?iterable
    {
        return null;
    }

    public function getStatus(): ?string
    {
        return 'some status';
    }

    public function getCode(): ?string
    {
        return '404';
    }

    public function getTitle(): ?string
    {
        return 'some tittle';
    }

    public function getDetail(): ?string
    {
        return 'some details';
    }

    public function getSource(): ?array
    {
        return null;
    }

    public function hasMeta(): bool
    {
        return false;
    }

    public function getMeta()
    {
        return null;
    }
}