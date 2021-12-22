<?php

namespace App\Core\Example\Infrastructure\SQL;

class Context
{
    public array $parameters = [];

    public function __invoke(...$values): string
    {
        return implode(', ', array_map([$this, 'parameter'], $values));
    }

    public function parameter($value): string
    {
        $name = 'p' . count($this->parameters);
        $this->parameters[$name] = $value;

        return ':' . $name;
    }
}